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
function getSched($table, $id){
    global $conn;
    $sql = "SELECT * FROM $table where frid = $id";
    $result = $conn->query($sql);
    return $result;
}
function schedAction($table, $where){
    global $conn;
    if(count($where) > 2){
        if($where["submit"] == "search_schedule"){
            // remove first element
            array_shift($where);
            return search($table, $where);
        } elseif ($where["submit"] == "insert_schedule") {
            $sql = "INSERT INTO $table (auid, frid, date_departure, time_departure, date_arrival, time_arrival, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisssss", $_SESSION["user_id"], $where["view_schedule"], $where["date_departure"], $where["time_departure"], $where["date_arrival"], $where["time_arrival"], $where["status"]);
            $stmt->execute();
            $stmt->close();
        } else {
            return getSched($table, $where["view_schedule"]);
        }
    } else {
        return getSched($table, $where["view_schedule"]);
    }

    return getSched($table, $where["view_schedule"]);
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
function getForeignValue($table, $column, $idColumn, $id) {
    global $conn;
    if (!$id) return null;
    $sql = "SELECT $column FROM $table WHERE $idColumn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($value);
    $stmt->fetch();
    $stmt->close();
    return $value ?? $id; // fallback: show ID if no match
}