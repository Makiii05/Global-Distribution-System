<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand fw-bold text-white" href="<?= $base ?>/Home">AirVia</a>

    <!-- Toggler -->
    <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?PHP if(isset($_SESSION["user_id"])){ ?>
    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item mx-2">
          <a class="nav-link text-white fw-semibold" href="<?= $base ?>Airline">Airline</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white fw-semibold" href="<?= $base ?>Airport">Airport</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white fw-semibold" href="<?= $base ?>Aircraft">Aircraft</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white fw-semibold" href="<?= $base ?>Route">Flight Route</a>
        </li>

        <!-- User dropdown -->
        <li class="nav-item dropdown mx-2">
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" 
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-5"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end bg-black border border-white shadow-sm" aria-labelledby="userDropdown">
            <?PHP if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]=="admin"){ ?>
            <li><a class="dropdown-item text-white" href="<?= $base ?>Accounts">Account</a></li>
            <li><a class="dropdown-item text-white" href="<?= $base ?>Import">Import File</a></li>
            <li><hr class="dropdown-divider border-light"></li>
            <?PHP }?>
            <?PHP if(isset($_SESSION["user_type"]) && $_SESSION["user_type"]=="admin"){ ?>
            <li><a class="dropdown-item text-white" href="<?= $base ?>Import">Import File</a></li>
            <li><hr class="dropdown-divider border-light"></li>
            <?PHP }?>
            <li><a class="dropdown-item text-danger fw-bold" href="<?= $base ?>Login">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <?PHP }?>
  </div>
</nav>

