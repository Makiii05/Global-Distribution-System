<?PHP
session_start();
if (!$_SESSION['user_role'] == "Administrator") {
    header("Location:../index.php");
}
