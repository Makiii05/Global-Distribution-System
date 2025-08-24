<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST["type"])){

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
        header("Location:../");
        exit;
    }
}
