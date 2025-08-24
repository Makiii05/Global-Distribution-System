<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["register"])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $confirm  = $_POST['confirmPassword'];
        $role     = $_POST['role'];

        // validate inputs
        if (empty($username) || empty($password) || empty($role)) {
            die("All fields are required!");
        }
        
        // check confirm password
        if ($password !== $confirm) {
            die("Passwords do not match!");
        }

        // check if username exists
        $stmt = $conn->prepare("SELECT id FROM tbluser WHERE user = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            die("Username already exists!");
        }
        $stmt->close();

        // insert new user
        $stmt = $conn->prepare("INSERT INTO tbluser (user, pass, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);

        if ($stmt->execute()) {
            $newId = $stmt->insert_id;

            $_SESSION["user_id"]   = $newId;
            $_SESSION["user_user"] = $username;
            $_SESSION["user_role"] = $role;

            header("Location:../Home");
            exit;
        } else {
            header("Location:../Register");
            exit;
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
            header("Location:../Login");
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