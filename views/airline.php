<?PHP
  if (isset($_POST["delete"])){
    deleteData("tblairline", $_POST["delete"]);
  }

  if (isset($_POST["Edit"])) {
      $id = $_POST["Edit"];
      editData("tblairline", $_POST, $id);
  }

  if (isset($_POST["Airline"])) {
    $data = search("tblairline", $_POST);
  } else {
    $data = getAll("tblairline");
  }
?>

<div class="d-flex flex-wrap">
  <!-- Left side: Form -->
  <div class="card border-dark shadow-lg p-4 m-3" style="width: 400px; flex-shrink: 0;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
      <i class="bi bi-search me-2"></i> Search
    </h3>
    <form action="<?= $base ?>Airline" method="POST">

      <input type="hidden" name="Airline">

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
        <label class="form-label fw-bold text-dark"><i class="bi bi-building me-1"></i> Airline Name</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="airlineName" name="airline_name" value="">
          </div>
          <input type="text" class="form-control border-dark" id="airlineNameValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-broadcast me-1"></i> Callsign</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="callsign" name="callsign" value="">
          </div>
          <input type="text" class="form-control border-dark" id="callsignValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-geo-alt me-1"></i> Region</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="region" name="region" value="">
          </div>
          <input type="text" class="form-control border-dark" id="regionValue">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-dark"><i class="bi bi-card-text me-1"></i> Comment</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="comment" name="comment" value="">
          </div>
          <input type="text" class="form-control border-dark" id="commentValue">
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
      <i class="bi bi-table me-2"></i> Airline Data
    </h3>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 80px;"><i class="bi bi-upc-scan"></i> IATA</th>
            <th style="min-width: 80px;"><i class="bi bi-upc"></i> ICAO</th>
            <th style="min-width: 200px;"><i class="bi bi-building"></i> Airline Name</th>
            <th style="min-width: 150px;"><i class="bi bi-broadcast"></i> Callsign</th>
            <th style="min-width: 120px;"><i class="bi bi-geo-alt"></i> Region</th>
            <th style="min-width: 200px; white-space: nowrap;"><i class="bi bi-card-text"></i> Comment</th>
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
            <td><?= $row["iata"] ?></td>
            <td><?= $row["icao"] ?></td>
            <td><?= $row["airline_name"] ?></td>
            <td><?= $row["callsign"] ?></td>
            <td><?= $row["region"] ?></td>
            <td style="white-space: nowrap;"><?= $row["comments"] ?></td>
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