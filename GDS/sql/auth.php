<?php
session_start();

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
    }
}

