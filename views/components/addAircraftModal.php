<!-- Modal -->
<div class="modal fade" id="addAircraftModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="addAircraftModalDialog">
        <div class="modal-content bg-white text-dark shadow-lg rounded-3">
            <form action="<?= $base ?>Aircraft" method="POST">
                <div class="modal-header border-0 border-bottom">
                    <h5 class="modal-title">Add Aircraft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex gap-3 ">

                        <!-- LEFT MAIN PANEL -->
                        <div class="border rounded p-3 flex-grow-1" id="left_panel">
                            <input type="hidden" name="insertAircraft">

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

                            <hr>

                            <!-- SEATPLAN OUTPUT -->
                            <div class="mb-2">
                                <label class="form-label fw-bold">Seat Plan</label>

                                <div class="d-flex gap-2">
                                    <label class="form-label fw-bold w-25">First</label>
                                    <input type="text" id="f_seatplan" name="f_seatplan"
                                            class="form-control mb-2" required style="pointer-events: none; user-select: none;">
                                </div>

                                <div class="d-flex gap-2">
                                    <label class="form-label fw-bold w-25">Business</label>
                                    <input type="text" id="c_seatplan" name="c_seatplan"
                                            class="form-control mb-2" required style="pointer-events: none; user-select: none;">
                                </div>

                                <div class="d-flex gap-2">
                                    <label class="form-label fw-bold w-25">Economy</label>
                                    <input type="text" id="y_seatplan" name="y_seatplan"
                                            class="form-control mb-2" required style="pointer-events: none; user-select: none;">
                                </div>
                            </div>

                            <div class="mb-2">
                                <input type="button" class="btn btn-dark form-control" id="btn_manage" value="Manage Seats">
                            </div>
                        </div>

                        <!-- MIDDLE PANEL (seat config) -->
                        <div class="border rounded p-3 d-none" id="seat_config_container">

                            <h6>SEAT CONFIGURATION</h6>

                            <!-- FIRST CLASS -->
                            <div class="mb-2">
                                <h6 class="fw-bold text-primary">First Class</h6>
                                <input type="number" name="f_col" id="f_col" class="form-control mb-1" placeholder="Cols">
                                <input type="number" name="f_row" id="f_row" class="form-control mb-1" placeholder="Rows">
                                <select id="f_orientation" name="f_orientation" class="form-control mb-1">
                                    <option value="">--Section--</option>
                                    <option value="front">Front</option>
                                    <option value="middle">Middle</option>
                                    <option value="back">Back</option>
                                </select>
                            </div>

                            <!-- BUSINESS CLASS -->
                            <div class="mb-2">
                                <h6 class="fw-bold text-warning">Business Class</h6>
                                <input type="number" name="c_col" id="c_col" class="form-control mb-1" placeholder="Cols">
                                <input type="number" name="c_row" id="c_row" class="form-control mb-1" placeholder="Rows">
                                <select id="c_orientation" name="c_orientation" class="form-control mb-1">
                                    <option value="">--Section--</option>
                                    <option value="front">Front</option>
                                    <option value="middle">Middle</option>
                                    <option value="back">Back</option>
                                </select>
                            </div>

                            <!-- ECONOMY CLASS -->
                            <div class="mb-2">
                                <h6 class="fw-bold text-success">Economy Class</h6>
                                <input type="number" name="y_col" id="y_col" class="form-control mb-1" placeholder="Cols">
                                <input type="number" name="y_row" id="y_row" class="form-control mb-1" placeholder="Rows">
                                <select id="y_orientation" name="y_orientation" class="form-control mb-1">
                                    <option value="">--Section--</option>
                                    <option value="front">Front</option>
                                    <option value="middle">Middle</option>
                                    <option value="back">Back</option>
                                </select>
                            </div>

                        </div>

                        <!-- RIGHT PANEL (seat preview) -->
                        <div class="border rounded p-3 d-none flex-grow-1" id="seat_preview_container">
                            <h6>PREVIEW</h6>

                            <div class="border border-2 p-3 bg-white rounded shadow-sm text-center">
                                <label class="text-secondary small fw-bold">FRONT SECTION</label>
                                <div id="front" class="seat-section mb-4"></div>

                                <label class="text-secondary small fw-bold">MIDDLE SECTION</label>
                                <div id="middle" class="seat-section mb-4"></div>

                                <label class="text-secondary small fw-bold">BACK SECTION</label>
                                <div id="back" class="seat-section mb-2"></div>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-outline-secondary px-3" id="btn_back">← Back</button>
                                <button type="button" id="save_seat" class="btn btn-success px-4">Save Seat</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-top border-0">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const sections = {
        front: document.getElementById('front'),
        middle: document.getElementById('middle'),
        back: document.getElementById('back')
    };

    /**
     * Toggles a specific seat element's state
     */
    function toggleSeatState(seat, forceState = null) {
        // If forceState is boolean, use it. Otherwise toggle current state.
        const currentState = seat.getAttribute("seat") === "1";
        const newState = forceState !== null ? forceState : !currentState;

        if (newState) {
            seat.setAttribute("seat", "1");
            seat.classList.add("selected");
        } else {
            seat.setAttribute("seat", "0");
            seat.classList.remove("selected");
        }
    }

    /**
     * Draws the Grid with Row/Col Checkboxes
     */
    function drawSeats(container, rows, cols) {
        container.innerHTML = "";
        container.className = "seat-grid-container";
        
        // CSS Grid Template: 
        // 1st col is Auto (for row headers), rest are 1fr (seats)
        container.style.gridTemplateColumns = `auto repeat(${cols}, auto)`;

        // --- 1. TOP LEFT CORNER (Empty Spacer) ---
        const spacer = document.createElement("div");
        container.appendChild(spacer);

        // --- 2. TOP ROW (Column Checkboxes) ---
        for (let c = 0; c < cols; c++) {
            const header = document.createElement("div");
            header.classList.add("grid-header", "d-flex", "ms-auto")
            
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input m-0";
            
            // Event: Select Entire Column
            checkbox.onchange = (e) => {
                const isChecked = e.target.checked;
                // Find all seats in this specific column index within this container
                const seatsInCol = container.querySelectorAll(`.seat[data-col="${c}"]`);
                seatsInCol.forEach(seat => toggleSeatState(seat, isChecked));
            };

            header.appendChild(checkbox);
            container.appendChild(header);
        }

        // --- 3. MAIN GRID (Row Checkbox + Seats) ---
        for (let r = 0; r < rows; r++) {
            
            // A. Row Header (Left Side)
            const rowHeader = document.createElement("div");
            rowHeader.classList.add("grid-header", "d-flex", "ms-auto")
            
            const rowCheckbox = document.createElement("input");
            rowCheckbox.type = "checkbox";
            rowCheckbox.className = "form-check-input m-0";

            // Event: Select Entire Row
            rowCheckbox.onchange = (e) => {
                const isChecked = e.target.checked;
                // Find all seats in this specific row index within this container
                const seatsInRow = container.querySelectorAll(`.seat[data-row="${r}"]`);
                seatsInRow.forEach(seat => toggleSeatState(seat, isChecked));
            };

            rowHeader.appendChild(rowCheckbox);
            container.appendChild(rowHeader);

            // B. The Seats for this Row
            for (let c = 0; c < cols; c++) {
                const seat = document.createElement("div");
                seat.classList.add("seat");
                seat.setAttribute("seat", "0");
                
                // Store coordinates for the checkboxes to find them later
                seat.setAttribute("data-row", r);
                seat.setAttribute("data-col", c);

                seat.classList.add("border", "border-dark")

                // Individual Click
                seat.onclick = () => toggleSeatState(seat);

                container.appendChild(seat);
            }
        }
    }

    function setupInputs(rowEl, colEl, orientationEl) {
        const update = () => {
            // Ensure inputs are numbers and orientation is selected
            const r = parseInt(rowEl.value);
            const c = parseInt(colEl.value);
            
            if (r > 0 && c > 0 && orientationEl.value !== "") {
                const target = sections[orientationEl.value];
                drawSeats(target, r, c);

                // Visual highlight for active section
                Object.values(sections).forEach(sec => sec.style.border = "none");
                target.style.border = "2px dashed #0d6efd"; 
            }
        };

        rowEl.oninput = update;
        colEl.oninput = update;
        orientationEl.onchange = update;
    }

    // Initialize Listeners
    setupInputs(document.getElementById('f_row'), document.getElementById('f_col'), document.getElementById('f_orientation'));
    setupInputs(document.getElementById('c_row'), document.getElementById('c_col'), document.getElementById('c_orientation'));
    setupInputs(document.getElementById('y_row'), document.getElementById('y_col'), document.getElementById('y_orientation'));

    // UI Toggles (Manage / Back Buttons)
    document.getElementById("btn_manage").onclick = () => {
        document.getElementById("seat_config_container").classList.remove("d-none");
        document.getElementById("seat_preview_container").classList.remove("d-none");
        document.getElementById("addAircraftModalDialog").classList.add("modal-xl");
        document.getElementById("left_panel").classList.remove("flex-grow-1");
    };

    document.getElementById("btn_back").onclick = () => {
        document.getElementById("seat_config_container").classList.add("d-none");
        document.getElementById("seat_preview_container").classList.add("d-none");
        document.getElementById("addAircraftModalDialog").classList.remove("modal-xl");
        document.getElementById("left_panel").classList.add("flex-grow-1");
    };

    // SAVE LOGIC
    document.getElementById("save_seat").onclick = () => {
        function getSeatplan(sectionId) {
            // If section is hidden/empty, return empty string
            if(!sectionId) return "";
            
            const arr = [];
            // We select .seat ensuring we don't grab the checkboxes
            // DOM order is preserved (Row 1 items, then Row 2 items...)
            const container = sections[sectionId];
            if(!container) return "";

            container.querySelectorAll('.seat').forEach(s => {
                arr.push(s.getAttribute("seat"));
            });
            return arr.join("");
        }

        // Helper to safely get value or empty
        const f_ort = document.getElementById('f_orientation').value;
        const c_ort = document.getElementById('c_orientation').value;
        const y_ort = document.getElementById('y_orientation').value;

        document.getElementById("f_seatplan").value = f_ort ? getSeatplan(f_ort) : "";
        document.getElementById("c_seatplan").value = c_ort ? getSeatplan(c_ort) : "";
        document.getElementById("y_seatplan").value = y_ort ? getSeatplan(y_ort) : "";
        
        // Optional: Alert user
        // alert("Seat plans generated!");
    };
</script>