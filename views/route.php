<?PHP
if (isset($_POST["delete"])) {
  deleteData("tblflightroute", $_POST["delete"]);
}

if (isset($_POST["Edit"])) {
    $id = $_POST["Edit"];
    editData("tblflightroute", $_POST, $id);
}

if (isset($_POST["Route"])) {
  $data = search("tblflightroute", $_POST);
} else {
  $data = getAll("tblflightroute");
}

if (isset($_POST["insertRoute"])) {
  insertRoute("tblflightroute", $_POST);
  $data = getAll("tblflightroute");
}

require("components/addRouteModal.php");
?>

<div class="d-flex flex-wrap">
  <!-- Left side: Form -->
  <div class="card border-dark shadow-lg p-4 m-3" style="width: 400px; flex-shrink: 0;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
      <i class="bi bi-search me-2"></i> Search
    </h3>
    <form action="<?= $base ?>Route" method="POST">
      
      <input type="hidden" name="Route">

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-hash me-1"></i> Airline</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="aid" name="aid" value="">
          </div>
          <select id="aidValue" class="form-control border-dark">
            <?PHP
            $airlines = $conn->query("SELECT * FROM tblairline");
            while($airline = $airlines->fetch_assoc()){
              echo "<option value=$airline[id]>$airline[airline_name]</option>";
            }?>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo me-1"></i> Origin Airport</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="oapid" name="oapid" value="">
          </div>
          <select id="oapidValue" class="form-control border-dark">
            <?PHP 
            $airports = $conn->query("SELECT * FROM tblairport");
            while($airport = $airports->fetch_assoc()){
              echo "<option value='{$airport['id']}'>$airport[airport_name]</option>";
            }?>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo-alt me-1"></i> Destination Airport</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="dapid" name="dapid" value="">
          </div>
          <select id="dapidValue" class="form-control border-dark">
            <?PHP 
            $airports = $conn->query("SELECT * FROM tblairport");
            while($airport = $airports->fetch_assoc()){
              echo "<option value='{$airport['id']}'>$airport[airport_name]</option>";
            }?>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-arrow-repeat me-1"></i> Round Trip</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="roundTrip" name="round_trip" value="">
          </div>
          <select id="roundTripValue" class="form-control border-dark">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-airplane me-1"></i> Aircraft</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="acid" name="acid" value="">
          </div>
          <select id="acidValue" class="form-control border-dark">
            <?PHP 
            $aircrafts = $conn->query("SELECT * FROM tblaircraft");
            while($aircraft = $aircrafts->fetch_assoc()){
              echo "<option value=$aircraft[id]>$aircraft[model]</option>";
            }?>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center">
        <i class="bi bi-search me-1"></i> Search
      </button>
    </form>
  </div>

  <!-- Right side: Table -->
  <div class="card border-dark shadow-lg p-4 m-3" style="flex: 1; min-width: 0;">
    <h3 class="mb-4 text-dark d-flex align-items-center">
      <i class="bi bi-table me-2"></i> Flight Route Data
      <?PHP if(!empty($_SESSION['user_aid'])):?>
      <button type="button"data-bs-toggle="modal" data-bs-target="#addRouteModal" class="btn btn-dark shadow-sm ms-auto d-flex align-items-center justify-content-center"><i class="bi bi-plus-square me-2"></i>Add Flight Route</button>
      <?PHP endif;?>
    </h3>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-hash"></i> Airline</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-geo"></i> Origin Airport</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-geo-alt"></i> Destination Airport</th>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-arrow-repeat"></i> Round Trip</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-airplane"></i> Aircraft</th>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-gear"></i> Action</th>
          </tr>
        </thead>
        <tbody>
        <?php if($data->num_rows == 0) { ?>
          <tr><td colspan="6" class="text-center text-muted">No matching records found.</td></tr>        
        <?php } ?>
        <?php while($row=$data->fetch_assoc()){ ?>
          <?php if((isset($_SESSION["user_aid"]) && $_SESSION["user_aid"] == $row['aid']) || (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin")){ ?>        
            <tr class="table-row-hover">
              <!-- Airline Name -->
              <td style="white-space: nowrap;">
                <?= getForeignValue("tblairline", "airline_name", "id", $row["aid"]) ?>
              </td>

              <!-- Origin Airport -->
              <td style="white-space: nowrap;">
                <?= getForeignValue("tblairport", "airport_name", "id", $row["oapid"]) ?>
              </td>

              <!-- Destination Airport -->
              <td style="white-space: nowrap;">
                <?= getForeignValue("tblairport", "airport_name", "id", $row["dapid"]) ?>
              </td>

              <!-- Round Trip -->
              <td style="white-space: nowrap;">
                <?= ($row["round_trip"] == 1) ? "Yes" : "No" ?>
              </td>

              <!-- Aircraft Model -->
              <td style="white-space: nowrap;">
                <?= getForeignValue("tblaircraft", "model", "id", $row["acid"]) ?>
              </td>

              <td class="text-center" style="white-space: nowrap;">
                <?php 
                if(isset($_SESSION["user_aid"]) && $_SESSION["user_aid"] == $row['aid']){            
                  include("components/action.php");
                }
                ?>
                <form action="<?= $base ?>Schedule" method="POST" style="display:inline;">
                  <input type="hidden" name="view_schedule" value="<?= $row["id"] ?>">
                  <button type="submit" class="btn fw-bold text-success p-0 border-success p-2 mx-2">
                    Schedule
                  </button>
                </form>
              </td>
            </tr>
          <?php } ?>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>