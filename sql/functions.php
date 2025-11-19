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
            $sql = "INSERT INTO $table (auid, frid, date_departure, time_departure, date_arrival, time_arrival, status, fclass_price, cclass_price, yclass_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisssssiii", $_SESSION["user_id"], $where["view_schedule"], $where["date_departure"], $where["time_departure"], $where["date_arrival"], $where["time_arrival"], $where["status"], $where["fclass_price"], $where["cclass_price"], $where["yclass_price"]);
            $stmt->execute();
            
            $id = $conn->insert_id;
            $aircraft_id = (string)$conn->query("SELECT ac.id AS aircraft_id FROM tblflightschedule fs JOIN tblflightroute fr ON fs.frid = fr.id JOIN tblaircraft ac ON fr.acid = ac.id WHERE fs.frid = $where[view_schedule]")->fetch_assoc()['aircraft_id'];
            createSeatPlan($id, $aircraft_id);

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
function createSeatPlan($fid, $aircraft_id) {
    global $conn;

    // FIX 1: Cast to int and use proper SQL parameter binding
    $aircraft_id = (int)$aircraft_id;
    
    // Fetch seat configuration from tblaircraftseat
    $sql = "SELECT
          acs.f_col, acs.f_row, acs.f_seatplan,
          acs.c_col, acs.c_row, acs.c_seatplan,
          acs.y_col, acs.y_row, acs.y_seatplan
          FROM tblaircraftseat acs
          WHERE acs.acid = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aircraft_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // FIX 2: Check if aircraft configuration exists
    if (!$row) {
        error_log("No seat configuration found for aircraft ID: $aircraft_id");
        return false;
    }

    // Class configurations with actual seatplan data
    $classes = [
        "First"    => [
            "cols" => (int)$row['f_col'],
            "rows" => (int)$row['f_row'],
            "seatplan" => $row['f_seatplan']
        ],
        "Business" => [
            "cols" => (int)$row['c_col'],
            "rows" => (int)$row['c_row'],
            "seatplan" => $row['c_seatplan']
        ],
        "Economy"  => [
            "cols" => (int)$row['y_col'],
            "rows" => (int)$row['y_row'],
            "seatplan" => $row['y_seatplan']
        ],
    ];

    $sql = "INSERT INTO tblseats (fid, ticket_no, seat_name, class, status) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $ticketCounter = 1; // Continuous ticket number across all classes

    foreach ($classes as $class => $data) {
        $cols = $data['cols'];
        $rows = $data['rows'];
        $seatplan = $data['seatplan'];
        
        // FIX 3: Generate seats based on seatplan (only where '1' exists)
        $seatNames = generateSeatNames($cols, $rows, $seatplan);
        
        foreach ($seatNames as $seatName) {
            $ticket_no = str_pad($ticketCounter, 6, '0', STR_PAD_LEFT);
            $status = "available";

            $stmt->bind_param("issss", $fid, $ticket_no, $seatName, $class, $status);
            
            if (!$stmt->execute()) {
                error_log("Failed to insert seat: $seatName for class $class. Error: " . $stmt->error);
            }

            $ticketCounter++;
        }
    }

    $stmt->close();
    return true;
}

// FIX 4: New function that respects the seatplan layout
function generateSeatNames($cols, $rows, $seatplan) {
    $seatNames = [];
    $letters = range('A', 'Z');
    $position = 0;
    
    // Loop through each row
    for ($row = 1; $row <= $rows; $row++) {
        $seatLetter = 0; // Counter for consecutive seat letters (A, B, C...)
        
        // Loop through each column in this row
        for ($col = 0; $col < $cols; $col++) {
            // Check if this position has a seat (1) in the seatplan
            if (isset($seatplan[$position]) && $seatplan[$position] === '1') {
                // Generate seat name: Consecutive Letter + Row Number
                $seatNames[] = $letters[$seatLetter] . $row;
                $seatLetter++; // Move to next letter for next seat
            }
            $position++;
        }
    }
    
    return $seatNames;
}
function insertRoute($table, $column){
    global $conn;
    $sql = "INSERT INTO $table (aid, oapid, dapid, round_trip, acid) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiii", $column["airline"], $column["oapid"], $column["dapid"], $column["round_trip"], $column["acid"]);
    $stmt->execute();

    $stmt->close();
}