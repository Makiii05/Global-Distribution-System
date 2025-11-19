<?PHP
if (isset($_POST["delete"])){
  deleteData("tblaircraft", $_POST["delete"]);
}

if (isset($_POST["Edit"])) {
    $id = $_POST["Edit"];
    editData("tblaircraft", $_POST, $id);
}

if (isset($_POST["insertAircraft"])){
    if (strlen($_POST["f_seatplan"]) == (int)$_POST["f_col"] * (int)$_POST["f_row"]
    && strlen($_POST["c_seatplan"]) == (int)$_POST["c_col"] * (int)$_POST["c_row"]
    && strlen($_POST["y_seatplan"]) == (int)$_POST["y_col"] * (int)$_POST["y_row"]
    ) {
      $conn->query("INSERT INTO tblaircraft (iata, icao, model) VALUES ('$_POST[iata]', '$_POST[icao]', '$_POST[model]')");
      $acid = $conn->insert_id;
      $conn->query("INSERT INTO tblaircraftseat (acid, f_col, f_row, f_seatplan, f_orientation, c_col, c_row, c_seatplan, c_orientation, y_col, y_row, y_seatplan, y_orientation)
      VALUES ($acid, $_POST[f_col], $_POST[f_row], '$_POST[f_seatplan]', '$_POST[f_orientation]', $_POST[c_col], $_POST[c_row], '$_POST[c_seatplan]', '$_POST[c_orientation]', $_POST[y_col], $_POST[y_row], '$_POST[y_seatplan]', '$_POST[y_orientation]')");
    }
}

if (isset($_POST["Aircraft"])) {
  $data = search("tblaircraft", $_POST);
} else {
    $sql = "SELECT
          ac.id AS id,
          ac.iata AS iata,
          ac.icao AS icao,
          ac.model AS model,
          acs.f_no AS first_class,
          acs.c_no AS business_class,
          acs.y_no AS economy_class,
          acs.f_col AS f_col,
          acs.f_row AS f_row,
          acs.f_no AS f_no,
          acs.f_seatplan AS f_seatplan,
          acs.f_orientation AS f_orientation,
          acs.y_col AS y_col,
          acs.y_row AS y_row,
          acs.y_no AS y_no,
          acs.y_seatplan AS y_seatplan,
          acs.y_orientation AS y_orientation,
          acs.c_col AS c_col,
          acs.c_row AS c_row,
          acs.c_no AS c_no,
          acs.c_seatplan AS c_seatplan,
          acs.c_orientation AS c_orientation
          FROM tblaircraft ac
          JOIN tblaircraftseat acs ON acs.acid = ac.id";
    $data = $conn->query($sql);
}
require("components/layoutModal.php");
require("components/addAircraftModal.php");
?>

<div class="d-flex flex-wrap">
  <!-- Left side: Form -->
  <div class="card border-dark shadow-lg p-4 m-3" style="width: 400px; flex-shrink: 0;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
      <i class="bi bi-search me-2"></i> Search
    </h3>
    <form action="<?= $base ?>Aircraft" method="POST">
      
      <input type="hidden" name="Aircraft">
      
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
        <label class="form-label fw-bold text-dark"><i class="bi bi-airplane me-1"></i> Model</label>
        <div class="input-group shadow-sm">
          <div class="input-group-text bg-white border-dark">
            <input type="checkbox" id="model" name="model" value="">
          </div>
          <input type="text" class="form-control border-dark" id="modelValue">
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
      <i class="bi bi-table me-2"></i> Aircraft Data
      <?PHP if(!empty($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"):?>
      <button type="button"data-bs-toggle="modal" data-bs-target="#addAircraftModal" class="btn btn-dark shadow-sm ms-auto d-flex align-items-center justify-content-center"><i class="bi bi-plus-square me-2"></i>Add Aircraft</button>
      <?PHP endif;?>
    </h3>
    <div class="table-responsive" style="max-height: 600px; overflow-x: auto;">
      <table class="table table-bordered border-dark align-middle shadow-sm">
        <thead class="table-dark sticky-top">
          <tr>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-upc-scan"></i> IATA</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-upc"></i> ICAO</th>
            <th style="min-width: 200px; white-space: nowrap;"><i class="bi bi-airplane"></i> Model</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-airplane"></i> First Class</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-airplane"></i> Business Class</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-airplane"></i> Economy Class</th>
            <th style="min-width: 80px; white-space: nowrap;"><i class="bi bi-grid-3x2-gap"></i> Layout</th>
            <?PHP if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){ ?>
            <th style="min-width: 120px; white-space: nowrap;"><i class="bi bi-gear"></i> Action</th>
            <?PHP }?>
          </tr>
        </thead>
        <tbody>
          <?PHP if($data->num_rows == 0) { ?>
            <tr><td colspan="4" class="text-center text-muted">No matching records found.</td></tr>        
          <?PHP }?>
          <?PHP while($row=$data->fetch_assoc()){ ?>
          <tr class="table-row-hover">
            <td style="white-space: nowrap;"><?= $row["iata"] ?></td>
            <td style="white-space: nowrap;"><?= $row["icao"] ?></td>
            <td style="white-space: nowrap;"><?= $row["model"] ?></td>
            <td style="white-space: nowrap;"><?= $row["first_class"] ?></td>
            <td style="white-space: nowrap;"><?= $row["business_class"] ?></td>
            <td style="white-space: nowrap;"><?= $row["economy_class"] ?></td>
            <td style="white-space: nowrap;">
              <button type="button" class="btn btn-link edit-btn border-dark p-2 mx-2" 
                onclick='modalLayout(<?= json_encode($row) ?>)'>
                <i class="bi bi-airplane text-dark"></i>
              </button>
            </td>
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