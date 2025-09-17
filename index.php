<?PHP
$conn = new mysqli("localhost", "root", "", "db_bash");

$result = $conn->query("SELECT * FROM users");

if(isset($_POST["order"]))
    $result = $conn->query("SELECT * FROM users ORDER BY $_POST[order]");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST" id="order_by_form">
        <select name="order" id="order_by">
            <option value="" disable>-select order-</option>
            <option value="id">Id</option>
            <option value="name">Name</option>
            <option value="age">Age</option>
        </select>
    </form>
    <table border=1>
        <tr><th>id</th><th>name</th><th>age</th></tr>
        <?PHP
        while($row=$result->fetch_assoc()){
            echo "<tr>
            <td>$row[id]</td>
            <td>$row[name]</td>
            <td>$row[age]</td>
            </tr>";
        }
        ?>
    </table>
    <a href="print/print_student.php">Print</a>
<script>
    let orderBy = document.getElementById("order_by")
    let orderByForm = document.getElementById("order_by_form")
    orderBy.onchange = function () {
        order_by_form.submit()
    }
</script>
</body>
</html>