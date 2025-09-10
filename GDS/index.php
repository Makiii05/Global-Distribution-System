<?php
session_start(); // This must be at the top of the file
$base = '/vanilla_project/GDS/';
include("sql/functions.php");

// --- Handle logout first ---
if (isset($_GET['page']) && $_GET['page'] === "Login") {
    logout(); // clear session before navbar renders
}
?>
<html>
<head>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="js/main.js" defer></script>
    <title>Global Distribution System</title>
</head>
<body>

<?php
include("views/components/navbar.php");
include("views/components/editModal.php");
include("views/components/seatModal.php");

// --- START ROUTING ---
$url = isset($_GET['page']) ? $_GET['page'] : '/';
$urlParts = explode('/', $url);

$page = $urlParts[0] ?? '/';
$param = $urlParts[1] ?? null;

switch($page){
    case "Airline":
        include("views/airline.php");
        break;
    case "Aircraft":
        include("views/aircraft.php");
        break;
    case "Airport":
        include("views/airport.php");
        break;
    case "Route":
        include("views/route.php");
        break;
    case "Schedule":
        include("views/schedule.php");
        break;
    case "Register":
        include("views/register.php");
        break;
    case "Login":
        include("views/login.php");
        break;
    case "Home":
        include("views/home.php");
        break;
    case "Accounts":
        include("views/accounts.php");
        break;
    case "Import":
        include("views/import.php");
        break;
    default:
        include("views/login.php");
        break;
}
// --- END ROUTING ---
?>

</body>
</html>
