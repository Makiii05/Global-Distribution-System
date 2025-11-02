<?php
session_start();

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

function redirect($role, $message){
    if ($role == "user"){
        if ($message == "success"){
            header("Location:../Home");
            exit;
        }else{
            header("Location:../Register?Error");
            exit;
        }
    }else{
        if ($message == "success"){
            header("Location:../Accounts?Success");
            exit;
        }else{
            header("Location:../Accounts?Error");
            exit;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["register"])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $confirm  = $_POST['confirmPassword'];
        $role     = $_POST['role'];

        // validate inputs
        if (empty($username) || empty($password) || empty($role)) {
            redirect($role, "error");
        }
        
        // check confirm password
        if ($password !== $confirm) {
            redirect($role, "error");
        }


        // check if username exists
        if (isset($_POST['aid'])){
            $stmt = $conn->prepare("SELECT id FROM tblairlineuser WHERE user = ?");
            $stmt->bind_param("s", $username);
        }else{
            $stmt = $conn->prepare("SELECT id FROM tbluser WHERE user = ? AND role = ?");
            $stmt->bind_param("ss", $username, $role);
        }
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            redirect($role, "error");
        }
        $stmt->close();


        if (isset($_POST['aid'])){
            $aid = $_POST['aid'];
            $type = $_POST['type'];
            // insert new airline user
            $stmt = $conn->prepare("INSERT INTO tblairlineuser (user, pass, type, aid) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $username, $password, $type, $aid);
        }else{
            // insert new user
            $stmt = $conn->prepare("INSERT INTO tbluser (user, pass, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $role);
        }

        if ($stmt->execute()) {
            $newId = $stmt->insert_id;

            $_SESSION["user_id"]   = $newId;
            $_SESSION["user_user"] = $username;
            $_SESSION["user_role"] = $role;
            $_SESSION["user_aid"] = isset($_POST["aid"]) ? $_POST['aid'] : "";
            $_SESSION["user_type"] = isset($_POST["type"]) ? $_POST['type'] : "";

            redirect($role, "success");
        } else {
            redirect($role, "error");
        }

        $stmt->close();
        $conn->close();
    }elseif (isset($_POST["type"])){

        $user = $_POST["username"];
        $pass = $_POST["password"];
        $type = $_POST["type"];

        // Choose table based on type
        $table = ($type == "user") ? "tbluser" : "tblairlineuser";

        // Use prepared statements
        $stmt = $conn->prepare("SELECT * FROM $table WHERE user = ? AND pass = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // invalid login → back to login page
            header("Location:../Login?Error");
            exit;
        } else {
            // fetch the row
            $row = $result->fetch_assoc();

            if ($type == "user") {
                $_SESSION["user_id"]   = $row["id"];
                $_SESSION["user_user"] = $row["user"];
                $_SESSION["user_role"] = $row["role"];
            } else {
                $_SESSION["user_id"]   = $row["id"];
                $_SESSION["user_user"] = $row["user"];
                $_SESSION["user_type"] = $row["type"];
                $_SESSION["user_aid"]  = $row["aid"];
            }

            // valid login → go to home page
            header("Location:../Home");
            exit;
        }
    }elseif (isset($_POST["submit_import_file"])) {

        $table = $_POST['table'];
        $columns = (int)$_POST['columns'];
        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls', 'csv', 'xlsx'];
        $_SESSION['error'] = []; // container for errors

        if (!in_array($file_ext, $allowed_ext)) {
            $_SESSION['error'][] = "Invalid file type. Allowed: CSV, XLS, XLSX.";
            header('Location: ../Import');
            exit(0);
        }

        try {
            $inputFileNamePath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            if (empty($data)) {
                $_SESSION['error'][] = "File is empty.";
                header('Location: ../Import');
                exit(0);
            }

            $count = 0;
            $header = [];
            foreach ($data as $row) {
                if ($count === 0) {
                    $header = $row;

                    // Check if header column count matches user input
                    if (count($header) != $columns) {
                        $_SESSION['error'][] = "Column count mismatch. Expected $columns, but file has " . count($header) . ".";
                        break;
                    }

                } else {
                    if (count($row) != $columns) {
                        $_SESSION['error'][] = "Row $count has " . count($row) . " columns, expected $columns.";
                        continue;
                    }

                    // Escape values
                    $values = [];
                    for ($i = 0; $i < $columns; $i++) {
                        $values[] = "'" . $conn->real_escape_string($row[$i]) . "'";
                    }

                    // Escape headers (use backticks for SQL safety)
                    $colNames = [];
                    for ($i = 0; $i < $columns; $i++) {
                        $colNames[] = "`" . $conn->real_escape_string($header[$i]) . "`";
                    }

                    $colStr = implode(',', $colNames);
                    $valStr = implode(',', $values);

                    $insertQuery = "INSERT INTO `$table` ($colStr) VALUES ($valStr)";
                    $result = mysqli_query($conn, $insertQuery);

                    if (!$result) {
                        if (strpos(mysqli_error($conn), 'Duplicate') !== false) {
                            $_SESSION['error'][] = "Duplicate entry found on row $count.";
                        } else {
                            $_SESSION['error'][] = "SQL error on row $count: " . mysqli_error($conn);
                        }
                    }
                }
                $count++;
            }

            if (empty($_SESSION['error'])) {
                $_SESSION['success'] = "Successfully imported $count rows.";
            }

        } catch (Exception $e) {
            $_SESSION['error'][] = "Error reading file: " . $e->getMessage();
        }

        header('Location: ../Import');
        exit(0);
    }
}

