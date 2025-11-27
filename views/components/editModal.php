<!-- White & Black Styled Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark shadow-lg rounded-3">
      <form action="" method="post">

        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h5 class="modal-title d-flex align-items-center" id="editModalLabel">
            <i class="bi bi-pencil-square me-2 text-dark"></i> Edit Record
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Hidden ID -->
        <input type="hidden" name="Edit" value="" id="idCon">
        <?PHP if(isset($_POST["view_schedule"])): ?>
        <input type="hidden" name="view_schedule" value="<?= $_POST["view_schedule"] ?>">
        <?PHP endif; ?>

        <!-- Modal Body -->
        <div class="modal-body" id="modalBody">
          <!-- JS will inject inputs here -->
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-dark d-flex align-items-center" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Close
          </button>
          <button type="submit" class="btn btn-dark text-white d-flex align-items-center">
            <i class="bi bi-save2-fill me-1"></i> Save changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
