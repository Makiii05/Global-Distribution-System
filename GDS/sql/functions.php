<?PHP

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gds";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


function getAll($table){
    global $conn;
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    return $result;
}
function search($table, $where){
    global $conn;

    if(count($where) > 1){
        // remove first element
        array_shift($where);

        // build conditions
        $conditions = [];
        foreach ($where as $key => $value) {
            $conditions[] = "$key = '$value'";
        }

        // join with AND
        $condi = implode(" AND ", $conditions);

        $sql = "SELECT * FROM $table WHERE $condi";
        $result = $conn->query($sql);    
        return $result;
    } else {
        return getAll($table);
    }
}
function deleteData($table, $id){
    global $conn;
    $sql = "DELETE FROM $table WHERE id = $id";
    return $conn->query($sql);
}
function editData($table, $set, $id){
    global $conn;
    // remove first element
    array_shift($set);

    // build key = value pairs
    $updates = [];
    foreach ($set as $key => $value) {
        $value = $conn->real_escape_string($value);
        $updates[] = "$key = '$value'";
    }

    $updateStr = implode(", ", $updates);

    $sql = "UPDATE $table SET $updateStr WHERE id = $id";
    return $conn->query($sql);
}
function logout(){
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();
}
