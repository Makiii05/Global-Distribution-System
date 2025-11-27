<!-- White & Black Styled Modal -->
<div class="modal fade" id="addRouteModal" tabindex="-1" aria-labelledby="addRouteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark shadow-lg rounded-3">
      <form action="<?= $base ?>Route" method="POST">
        <input type="hidden" name="insertRoute" value="<?= $_SESSION["user_aid"]?>">
        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h5 class="modal-title d-flex align-items-center" id="editModalLabel">
            <i class="bi bi-pencil-square me-2 text-dark"></i> Add Route 
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body" id="modalBody">
            <input type="hidden" class="form-control" name="airline" value="<?= $_SESSION["user_aid"]?>" readonly>

            <div class="mb-2">
                <label class="form-label fw-bold">Origin Airport</label>
                <select name="oapid" class="form-control" required>
                <option value="" disabled selected>-- Choose an airport --</option>
                <?PHP $airports = $conn->query("SELECT * FROM tblairport "); ?>
                <?PHP foreach ($airports as $airport) {?>
                    <option value="<?= $airport['id'] ?>"><?= $airport['airport_name']?></option>
                <?PHP }?>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold">Destination Airport</label>
                <select name="dapid" class="form-control" required>
                <option value="" disabled selected>-- Choose an airport --</option>
                <?PHP $airports = $conn->query("SELECT * FROM tblairport "); ?>
                <?PHP foreach ($airports as $airport) {?>
                    <option value="<?= $airport['id'] ?>"><?= $airport['airport_name']?></option>
                <?PHP }?>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold">Round Trip</label>
                <select name="round_trip" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold">Aircraft</label>
                <select name="acid" class="form-control" required>
                <option value="" disabled selected>-- Choose an aircraft --</option>
                <?PHP $aircrafts = $conn->query("SELECT * FROM tblaircraft "); ?>
                <?PHP foreach ($aircrafts as $aircraft) {?>
                    <option value="<?= $aircraft['id'] ?>"><?= $aircraft['model']?></option>
                <?PHP }?>
                </select>
            </div>
            
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-dark d-flex align-items-center" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Close
          </button>
          <button type="submit" class="btn btn-dark text-white d-flex align-items-center">
            <i class="bi bi-save2-fill me-1"></i> Save Route
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
