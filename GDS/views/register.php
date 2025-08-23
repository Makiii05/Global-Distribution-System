
<!-- Register Card -->
<div class="card border-dark shadow-lg p-4 mx-auto mt-5 login-register-card" style="width: 450px;">
    <h3 class="text-center mb-4 text-dark d-flex align-items-center justify-content-center">
        <i class="bi bi-person-plus me-2"></i> Register
    </h3>

    <form action="register_process.php" method="POST">
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

        <button type="submit" class="btn btn-dark shadow-sm w-100 d-flex align-items-center justify-content-center">
            <i class="bi bi-person-plus me-1"></i> Register
        </button>
    </form>

    <div class="text-center mt-3 text-dark">
        <small>Already have an account? <a href="<?= $base ?>Login">Login here</a></small>
    </div>
</div>
