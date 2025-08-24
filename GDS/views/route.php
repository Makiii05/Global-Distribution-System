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
        <label class="form-label fw-bold text-dark"><i class="bi bi-hash me-1"></i> AID</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="aid" name="aid" value="">
          </div>
          <input type="text" class="form-control border-dark" id="aidValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo me-1"></i> OAPID</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="oapid" name="oapid" value="">
          </div>
          <input type="text" class="form-control border-dark" id="oapidValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo-alt me-1"></i> DAPID</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="dapid" name="dapid" value="">
          </div>
          <input type="text" class="form-control border-dark" id="dapidValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-arrow-repeat me-1"></i> Round Trip</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="roundTrip" name="round_trip" value="">
          </div>
          <input type="text" class="form-control border-dark" id="roundTripValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-airplane me-1"></i> ACID</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="acid" name="acid" value="">
          </div>
          <input type="text" class="form-control border-dark" id="acidValue">
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
    </h3>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-hash"></i> AID</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-geo"></i> OAPID</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-geo-alt"></i> DAPID</th>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-arrow-repeat"></i> Round Trip</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-airplane"></i> ACID</th>
            <?PHP if(isset($_SESSION["user_aid"])){ ?>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-gear"></i> Action</th>
            <?PHP }?>
          </tr>
        </thead>
        <tbody>
          <?PHP if($data->num_rows == 0) { ?>
            <tr><td colspan="6" class="text-center text-muted">No matching records found.</td></tr>        
          <?PHP }?>
          <?PHP while($row=$data->fetch_assoc()){ ?>
          <tr class="table-row-hover">
            <td style="white-space: nowrap;"><?= $row["aid"] ?></td>
            <td style="white-space: nowrap;"><?= $row["oapid"] ?></td>
            <td style="white-space: nowrap;"><?= $row["dapid"] ?></td>
            <td style="white-space: nowrap;"><?= ($row["round_trip"] == 1) ? "Yes" : "No" ?></td>
            <td style="white-space: nowrap;"><?= $row["acid"] ?></td>
            <?PHP if(isset($_SESSION["user_aid"]) == $row['aid']){ ?>
            <td class="text-center" style="white-space: nowrap;">
              <?php include("components/action.php")?>
            </td>
            <?PHP }?>
          </tr>
          <?PHP }?>
        </tbody>
      </table>
    </div>
  </div>
</div>