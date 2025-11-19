<!-- Aircraft Layout Modal -->
<style>
    .seat {
        width: 32px;
        aspect-ratio: 1/1;
        border-radius: 6px;
        margin-left: 8px;
        border: 2px solid transparent;
    }
    .seat-section {
        display: grid;
        gap: 2px;
        justify-content: center;
    }
</style>

<div class="modal modal-xl fade" id="scheduleLayoutModal" tabindex="-1" aria-labelledby="scheduleLayoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-bg-light text-dark shadow-lg rounded-3">

            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title" id="scheduleLayoutModalLabel">
                    <i class="bi bi-grid-3x3-gap-fill me-2 text-dark"></i> Aircraft Seat Layout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center" id="scheduleLayoutModalBody">

                <!-- LEGENDS -->
                <label class="text-secondary small fw-bold">LEGENDS</label>
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-center mb-4">

                        <div class="d-flex align-items-center mx-4">
                            <span>First Class</span>
                            <div class="ms-2 p-1 px-3 bg-success border-3"></div>
                        </div>
                        <div class="d-flex align-items-center mx-4">
                            <span>Business Class</span>
                            <div class="ms-2 p-1 px-3 bg-danger border-3"></div>
                        </div>
                        <div class="d-flex align-items-center mx-4">
                            <span>Economy Class</span>
                            <div class="ms-2 p-1 px-3 bg-warning border-3"></div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="d-flex align-items-center mx-4">
                            <span>Available</span>
                            <div class="seat border border-secondary border-3"></div>
                        </div>
                        <div class="d-flex align-items-center mx-4">
                            <span>Occupied</span>
                            <div class="seat bg-secondary border-3"></div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="p-4 d-flex flex-column align-items-center">

                    <div class="border border-2 p-3 bg-white rounded shadow-sm text-center">
                        <!-- FRONT -->
                        <label class="text-secondary small fw-bold">FRONT SECTION</label>
                        <div id="front_section" class="seat-section mb-4"></div>

                        <!-- MIDDLE -->
                        <label class="text-secondary small fw-bold">MIDDLE SECTION</label>
                        <div id="middle_section" class="seat-section mb-4"></div>

                        <!-- BACK -->
                        <label class="text-secondary small fw-bold">BACK SECTION</label>
                        <div id="back_section" class="seat-section mb-4"></div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>
