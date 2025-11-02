<div class="d-flex justify-content-center align-items-start gap-4 mt-5">
    <!-- Accounts Register Card -->
    <div class="card border-dark shadow-lg p-4 login-register-card" style="width: 450px;">
        <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
            <i class="bi bi-person-plus me-2"></i> Register Airline User
        </h3>

        <form action="sql/auth.php" method="POST">
            <input type="hidden" name="role" value="airlineuser">
            <div class="mb-3">
                <label for="username" class="form-label fw-bold text-dark">Username</label>
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control border-dark" id="username" name="username" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold text-dark">Password</label>
                <div class="input-group shadow-sm">
                    <input type="password" class="form-control border-dark" id="password" name="password" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label fw-bold text-dark">Confirm Password</label>
                <div class="input-group shadow-sm">
                    <input type="password" class="form-control border-dark" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label fw-bold text-dark">User Type</label>
                <div class="input-group shadow-sm">
                    <select class="form-control border-dark" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="aid" class="form-label fw-bold text-dark">Airline</label>
                <div class="input-group shadow-sm">
                    <select class="form-control border-dark" id="aid" name="aid" required>
                        <option value="">Select Airline</option>
                        <?php
                        // Fetch airlines from database
                        $conn = new mysqli("localhost", "root", "", "gds");
                        $result = $conn->query("SELECT id, airline_name FROM tblairline");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['airline_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <?php if(isset($_GET["Error"])): ?>
                <div class="alert alert-danger text-center py-2">
                    Password not match or Username already exists!
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["Success"])): ?>
                <div class="alert alert-success text-center py-2">
                    Account created successfully!
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center" name="register">
                <i class="bi bi-person-plus me-1"></i> Register
            </button>
        </form>
    </div>

    <!-- Register Card -->
    <div class="card border-dark shadow-lg p-4 login-register-card" style="width: 450px;">
        <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
            <i class="bi bi-person-plus me-2"></i> Register Admin
        </h3>

        <form action="sql/auth.php" method="POST">
            <input type="hidden" name="role" value="admin">
            <div class="mb-3">
                <label for="username" class="form-label fw-bold text-dark">Username</label>
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control border-dark" id="username" name="username" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold text-dark">Password</label>
                <div class="input-group shadow-sm">
                    <input type="password" class="form-control border-dark" id="password" name="password" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label fw-bold text-dark">Confirm Password</label>
                <div class="input-group shadow-sm">
                    <input type="password" class="form-control border-dark" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>
            <?php if(isset($_GET["Error"])): ?>
                <div class="alert alert-danger text-center py-2">
                    Password not match or Username already exists!
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["Success"])): ?>
                <div class="alert alert-success text-center py-2">
                    Account created successfully!
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center" name="register">
                <i class="bi bi-person-plus me-1"></i> Register
            </button>
        </form>
    </div>
</div>
