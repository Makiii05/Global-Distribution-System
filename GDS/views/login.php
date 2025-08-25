<!-- Login Card -->
<div class="card border-dark shadow-lg p-4 mx-auto mt-5 login-register-card" style="width: 400px;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
        <i class="bi bi-box-arrow-in-right me-2"></i> Login
    </h3>

    <!-- Role toggle -->
    <div class="btn-group w-100 mb-3" role="group" aria-label="Login type">
        <button type="button" class="btn btn-outline-dark active" data-role="user">Normal User</button>
        <button type="button" class="btn btn-outline-dark" data-role="airline_user">Airline User</button>
    </div>

    <form action="sql/auth.php" method="POST">
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
        <?php if(isset($_GET["Error"])): ?>
            <div class="alert alert-danger text-center py-2">
                Invalid username or password.
            </div>
        <?php endif; ?>

        <button type="submit" 
                class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center" 
                name="type" value="user" id="submit_btn">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
        </button>
    </form>

    <div class="text-center mt-3 text-dark">
        <small>Don’t have an account? <a href="<?= $base ?>Register">Register here</a></small>
    </div>
</div>