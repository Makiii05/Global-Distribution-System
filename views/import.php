<!-- Import Card -->
<div class="card border-dark shadow-lg p-4 mx-auto mt-5 login-register-card" style="width: 450px;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
        <i class="bi bi-file-earmark-arrow-up me-2"></i> Import Data
    </h3>

    <form action="sql/auth.php" method="POST" enctype="multipart/form-data">
        
        <!-- Table Selection -->
        <div class="mb-3">
            <label for="tableSelect" class="form-label fw-bold text-dark">Select Table</label>
            <div class="input-group shadow-sm">
                <select class="form-select border-dark" id="tableSelect" name="table" required>
                    <option value="" disabled selected>-- Choose a table --</option>
                    <?PHP if($_SESSION["user_role"] == "admin"){?>
                    <option value="tblaircraft">Aircraft Table</option>
                    <option value="tblairline">Airline Table</option>
                    <option value="tblairport">Airport Table</option>
                    <?PHP }?>
                </select>
            </div>
        </div>

        <!-- File Upload -->
        <div class="mb-3">
            <label for="importFile" class="form-label fw-bold text-dark">Select File</label>
            <div class="input-group shadow-sm">
                <input type="file" class="form-control border-dark" id="importFile" name="import_file" accept=".csv, .xlsx" required>
            </div>
        </div>

        <!-- Number of Columns -->
        <div class="mb-3">
            <label for="columns" class="form-label fw-bold text-dark">Number of Columns in File</label>
            <div class="input-group shadow-sm">
                <input type="number" class="form-control border-dark" id="columns" name="columns" min="1" required>
            </div>
        </div>
        
        <!-- Error / Success Messages -->
        <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-start py-2">
                <ul class="mb-0">
                    <?php foreach($_SESSION['error'] as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; unset($_SESSION['error']); ?>
                </ul>
            </div>
        <?php elseif(isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-center py-2">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Submit -->
        <button type="submit" name="submit_import_file"
                class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center">
            <i class="bi bi-upload me-1"></i> Import
        </button>
    </form>
</div>
