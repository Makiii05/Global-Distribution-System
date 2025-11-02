<!-- White & Black Styled Modal -->
<div class="modal fade" id="addRouteModal" tabindex="-1" aria-labelledby="addRouteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark shadow-lg rounded-3">
      <form action="../" method="post">

        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h5 class="modal-title d-flex align-items-center" id="editModalLabel">
            <i class="bi bi-pencil-square me-2 text-dark"></i> Add Route 
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body" id="modalBody">
            <div class="mb-2">
                <label class="form-label fw-bold">Airline</label>
                <input type="text" class="form-control" name="airline" value="<?= $_SESSION["user_aid"]?>" required>
            </div>

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
                <select name="oapid" class="form-control" required>
                <option value="" disabled selected>-- Choose an airport --</option>
                <?PHP $airports = $conn->query("SELECT * FROM tblairport "); ?>
                <?PHP foreach ($airports as $airport) {?>
                    <option value="<?= $airport['id'] ?>"><?= $airport['airport_name']?></option>
                <?PHP }?>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold">Round Trip</label>
                <select name="oapid" class="form-control" required>
                    <option value="1">True</option>
                    <option value="0">False</option>
                </select>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold">Aircraft</label>
                <select name="oapid" class="form-control" required>
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
