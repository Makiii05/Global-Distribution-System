<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bash Command Prompt</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark text-white">

  <!-- Terminal Header -->
  <div class="container bg-secondary bg-gradient rounded-top-2 text-center p-1 small fw-semibold mt-3">
      Mark Anthony Lina
  </div>

  <!-- Terminal Body -->
  <div class="container bg-dark border border-top-0 border-secondary rounded-bottom-2 p-2 mb-0" 
       style="height: 450px; overflow-y: auto; font-family: monospace;">
      <?php
      $conn = new mysqli("localhost", "root", "", "cmd");
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $result = $conn->query("SELECT * FROM prompt");
      while ($row = $result->fetch_assoc()) {
          $type = $row['type'];
          $name = htmlspecialchars($row['name']);
          echo '<div class="mb-1">';
          echo '<span class="text-warning">user@localhost</span>:<span class="text-info">~</span>$ ';
          if ($type === 'directory') {
              echo "New directory <span class='text-success'>{$name}</span> created";
          } elseif ($type === 'file') {
              echo "New file <span class='text-success'>{$name}</span> created";
          } elseif ($type === 'error') {
              echo "<span class='text-danger'>Error: {$name}</span>";
          } elseif ($type === 'ls') {
              echo "<span class='text-light'>{$name}</span>";
          }
          echo '</div>';
      }
      $conn->close();
      ?>
  </div>

  <!-- Terminal Input -->
  <div class="container d-flex align-items-center px-2 py-1 bg-dark">
      <i class="bi bi-currency-dollar me-2 text-warning"></i>
      <form action="function.php" method="POST" class="w-100">
          <input type="text" name="prompt" class="form-control bg-dark text-success border-0 shadow-none"
                 placeholder="Enter your command here" required style="font-family: monospace;">
      </form>  
  </div>

</body>
</html>
