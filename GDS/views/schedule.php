<?php
// --- Flight Schedule Logic ---

$id = $_POST["view_schedule"] ?? $_GET["view_schedule"] ?? null;

if(empty($id)) {
    header("Location: ".$base."Route");
}

if (isset($_POST["delete"])) {
    deleteData("tblflightschedule", $_POST["delete"]);
}

if (isset($_POST["Edit"])) {
    $id = $_POST["Edit"];
    editData("tblflightschedule", $_POST, $id);
}

if (isset($_POST["submit"])) {
    $data = schedAction("tblflightschedule", $_POST);
} else {
    $data = getSched("tblflightschedule", $id);
}

$route = $conn->query("SELECT * FROM tblflightroute WHERE id = $id")->fetch_assoc();
// First fetch airline ID, origin airport, destination airport from route
$sql = "SELECT a.airline_name, o.airport_name AS origin, d.airport_name AS dest, c.model AS aircraft
        FROM tblflightroute fr
        LEFT JOIN tblairline a ON fr.aid = a.id
        LEFT JOIN tblairport o ON fr.oapid = o.id
        LEFT JOIN tblairport d ON fr.dapid = d.id
        LEFT JOIN tblaircraft c ON fr.acid = c.id
        WHERE fr.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $route["id"]);
$stmt->execute();
$stmt->bind_result($airlineName, $origin, $dest, $aircraft);
$stmt->fetch();
$stmt->close();
?>


<div class="d-flex flex-wrap">
  <!-- Left side: Form -->
  <div class="card border-dark shadow-lg p-4 m-3" style="width: 400px; flex-shrink: 0;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
      <i class="bi bi-search me-2"></i> Search Flight Schedule
    </h3>
    
    <?PHP if (isset($_SESSION["user_aid"])) { ?>
    <!-- Role toggle -->
      <div class="btn-group w-100 mb-3" role="group" aria-label="Login type">
          <button type="button" class="btn btn-outline-dark active" data-role="search_schedule">Search</button>
          <button type="button" class="btn btn-outline-dark" data-role="insert_schedule">Insert</button>
      </div>
    <?PHP } ?>

    <form action="<?= $base ?>Schedule" method="POST">

      <input type="hidden" name="view_schedule" value="<?= $id ?>">
      <input type="hidden" name="submit" id="submit_inp" value="search_schedule"">

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-calendar-date me-1"></i> Date Departure</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="dateDeparture" name="date_departure" value="">
          </div>
          <input type="date" class="form-control border-dark" id="dateDepartureValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-clock me-1"></i> Time Departure</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="timeDeparture" name="time_departure" value="">
          </div>
          <input type="time" class="form-control border-dark" id="timeDepartureValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-calendar-check me-1"></i> Date Arrival</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="dateArrival" name="date_arrival" value="">
          </div>
          <input type="date" class="form-control border-dark" id="dateArrivalValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-clock-history me-1"></i> Time Arrival</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="timeArrival" name="time_arrival" value="">
          </div>
          <input type="time" class="form-control border-dark" id="timeArrivalValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-info-circle me-1"></i> Status</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="status" name="status" value="">
          </div>
          <input type="text" class="form-control border-dark" id="statusValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-coin me-1"></i> First Class Price</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="fclassPrice" name="fclass_price" value="">
          </div>
          <input type="number" class="form-control border-dark" id="fclassPriceValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-coin me-1"></i> Business Class Price</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="cclassPrice" name="cclass_price" value="">
          </div>
          <input type="number" class="form-control border-dark" id="cclassPriceValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-coin me-1"></i> Economy Class Price</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="yclassPrice" name="yclass_price" value="">
          </div>
          <input type="number" class="form-control border-dark" id="yclassPriceValue">
        </div>
      </div>

      <button type="submit" id="submit_btn" value="search_schedule" class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center">
        <i class='bi bi-search me-1'></i> Search
      </button>
    </form>
  </div>
  <!-- Right side: Table -->
  <div class="card border-dark shadow-lg p-4 m-3" style="flex: 1; min-width: 0;">
    <div class="row mb-2">
      <div class="col-md-4">
        <p><b>Airline:</b> <small><?= $airlineName ?></small></p>
      </div>
      <div class="col-md-4">
        <p><b>Origin:</b> <small><?= $origin ?></small></p>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-md-4">
        <p><b>Aircraft:</b> <small><?= $aircraft ?></small></p>
      </div>
      <div class="col-md-4">
        <p><b>Destination:</b> <small><?= $dest ?></small></p>
      </div>
    </div>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm rounded-3">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 140px; white-space: nowrap;"><i class="bi bi-calendar-date"></i> Date Departure</th>
            <th style="min-width: 140px; white-space: nowrap;"><i class="bi bi-clock"></i> Time Departure</th>
            <th style="min-width: 130px; white-space: nowrap;"><i class="bi bi-calendar-check"></i> Date Arrival</th>
            <th style="min-width: 130px; white-space: nowrap;"><i class="bi bi-clock-history"></i> Time Arrival</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-info-circle"></i> Status</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-info-circle"></i> Seat</th>
            <?PHP if(isset($_SESSION["user_aid"])){ ?>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-gear"></i> Action</th>
            <?PHP }?>
          </tr>
        </thead>
        <tbody>
        <?PHP if($data->num_rows == 0) { ?>
        <tr><td colspan="8" class="text-center text-muted">No matching records found.</td></tr>        
        <?PHP } ?>
        <?PHP while($row=$data->fetch_assoc()){ ?>
        <tr class="table-row-hover">

        <!-- Dates & Times -->
        <td style="white-space: nowrap;"><?= $row["date_departure"] ?></td>
        <td style="white-space: nowrap;"><?= $row["time_departure"] ?></td>
        <td style="white-space: nowrap;"><?= $row["date_arrival"] ?></td>
        <td style="white-space: nowrap;"><?= $row["time_arrival"] ?></td>
        <td style="white-space: nowrap;"><?= ucfirst($row["status"]) ?></td>
        <td class="text-center" style="white-space: nowrap;">
            <?php include("components/seat.php")?>
        </td>
        <?PHP if (isset($_SESSION["user_aid"])): ?>
        <td class="text-center" style="white-space: nowrap;">
            <?php include("components/action.php")?>
        </td>
        <?PHP endif; ?>
        </tr>
        <?PHP } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>