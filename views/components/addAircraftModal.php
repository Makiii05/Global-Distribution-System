<!-- White & Black Styled Modal -->
<div class="modal fade" id="addAircraftModal" tabindex="-1" aria-labelledby="addAircraftModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark shadow-lg rounded-3">
      <form action="<?= $base ?>Aircraft" method="POST">
        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h5 class="modal-title d-flex align-items-center" id="addAircraftModalLabel">
            <i class="bi bi-pencil-square me-2 text-dark"></i> Add Aircraft 
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body" id="modalBody">
          <input type="hidden" name="insertAircraft">
          <input type="hidden" name="first_row">
          <input type="hidden" name="first_col">
          <input type="hidden" name="business_row">
          <input type="hidden" name="business_col">
          <input type="hidden" name="economy_row">
          <input type="hidden" name="economy_col">
          <input type="hidden" name="seats">
            <div class="mb-2">
                <label class="form-label fw-bold">IATA</label>
                <input type="text" class="form-control" name="iata" required>
            </div>
            <div class="mb-2">
                <label class="form-label fw-bold">ICAO</label>
                <input type="text" class="form-control" name="icao" required>
            </div>
            <div class="mb-2">
                <label class="form-label fw-bold">Model</label>
                <input type="text" class="form-control" name="model" required>
            </div>
            <div class="mb-2">
                <label class="form-label fw-bold">Manage Seats</label>
                <input type="button" class="btn btn-dark form-control" value="Manage Seats">
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
