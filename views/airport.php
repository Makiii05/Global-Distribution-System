<?PHP
if (isset($_POST["delete"])) {
  deleteData("tblairport", $_POST["delete"]);
}

if (isset($_POST["Edit"])) {
    $id = $_POST["Edit"];
    editData("tblairport", $_POST, $id);
}

if (isset($_POST["Airport"])) {
  $data = search("tblairport", $_POST);
} else {
  $data = getAll("tblairport");
}
?>

<div class="d-flex flex-wrap">
  <!-- Left side: Form -->
  <div class="card border-dark shadow-lg p-4 m-3" style="width: 400px; flex-shrink: 0;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
      <i class="bi bi-search me-2"></i> Search Airport
    </h3>
    <form action="<?= $base ?>Airport" method="POST">
      
      <input type="hidden" name="Airport">

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-upc-scan me-1"></i> IATA</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="iata" name="iata" value="">
          </div>
          <input type="text" class="form-control border-dark" id="iataValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-upc me-1"></i> ICAO</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="icao" name="icao" value="">
          </div>
          <input type="text" class="form-control border-dark" id="icaoValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-building me-1"></i> Airport Name</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="airportName" name="airport_name" value="">
          </div>
          <input type="text" class="form-control border-dark" id="airportNameValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo-alt me-1"></i> Location Serve</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="locationServe" name="location_serve" value="">
          </div>
          <input type="text" class="form-control border-dark" id="locationServeValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-clock me-1"></i> Time</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="time" name="time" value="">
          </div>
          <input type="text" class="form-control border-dark" id="timeValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-brightness-high me-1"></i> DST</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="dst" name="dst" value="">
          </div>
          <input type="text" class="form-control border-dark" id="dstValue">
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
      <i class="bi bi-table me-2"></i> Airport Data
    </h3>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-upc-scan"></i> IATA</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-upc"></i> ICAO</th>
            <th style="min-width: 200px; white-space: nowrap;"><i class="bi bi-building"></i> Airport Name</th>
            <th style="min-width: 180px; white-space: nowrap;"><i class="bi bi-geo-alt"></i> Location Serve</th>
            <th style="min-width: 100px; white-space: nowrap;"><i class="bi bi-clock"></i> Time</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-brightness-high"></i> DST</th>
            <?PHP if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){ ?>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-gear"></i> Action</th>
            <?PHP }?>
          </tr>
        </thead>
        <tbody>
          <?PHP if($data->num_rows == 0) { ?>
            <tr><td colspan="7" class="text-center text-muted">No matching records found.</td></tr>        
          <?PHP }?>
          <?PHP while($row=$data->fetch_assoc()){ ?>
          <tr class="table-row-hover">
            <td style="white-space: nowrap;"><?= $row["iata"] ?></td>
            <td style="white-space: nowrap;"><?= $row["icao"] ?></td>
            <td style="white-space: nowrap;"><?= $row["airport_name"] ?></td>
            <td style="white-space: nowrap;"><?= $row["location_serve"] ?></td>
            <td style="white-space: nowrap;"><?= $row["time"] ?></td>
            <td style="white-space: nowrap;"><?= $row["dst"] ?></td>
            <?PHP if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){ ?>
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