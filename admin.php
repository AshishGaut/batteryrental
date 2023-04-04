<!DOCTYPE html>
<html>
<head>
  <title>Vehicle and Battery Information</title>
</head>
<body>
  
  <?php
  // Database connection details
  include 'config.php';
  
  // Handle battery search
if(isset($_POST['battery_search'])) {
  $battery_search_term = "%" . $_POST['battery_search_term'] . "%";
  $battery_sql = "SELECT * FROM battery WHERE name LIKE ? OR capacity LIKE ? OR purchase_date LIKE ? OR battery_health LIKE ? OR charge_cycle LIKE ? OR vehicle_number LIKE ?";
  $battery_stmt = $conn->prepare($battery_sql);
  $battery_stmt->bind_param("ssssss", $battery_search_term, $battery_search_term, $battery_search_term, $battery_search_term, $battery_search_term, $battery_search_term);
  $battery_stmt->execute();
  $battery_result = $battery_stmt->get_result();
} else {
  // Query to retrieve all data from battery table
  $battery_sql = "SELECT * FROM battery";
  $battery_result = $conn->query($battery_sql);
}

// Handle vehicle search
if(isset($_POST['vehicle_search'])) {
  $vehicle_search_term = "%" . $_POST['vehicle_search_term'] . "%";
  $vehicle_sql = "SELECT * FROM vehicle WHERE name LIKE ? OR battery_capacity LIKE ? OR vehicle_number LIKE ? OR owner LIKE ? OR contact_number LIKE ? OR driver_license_number LIKE ?";
  $vehicle_stmt = $conn->prepare($vehicle_sql);
  $vehicle_stmt->bind_param("ssssss", $vehicle_search_term, $vehicle_search_term, $vehicle_search_term, $vehicle_search_term, $vehicle_search_term, $vehicle_search_term);
  $vehicle_stmt->execute();
  $vehicle_result = $vehicle_stmt->get_result();
} else {
  $vehicle_sql = "SELECT * FROM vehicle";
  $vehicle_result = $conn->query($vehicle_sql);
}

  // Print vehicle table data in a table
  echo "<h2>Vehicle Information</h2>";
  echo "<form method='post'>";
  echo "<input type='text' name='vehicle_search_term' placeholder='Search vehicle table'>";
  echo "<input type='submit' name='vehicle_search' value='Search'>";
  echo "</form>";
  echo "<table>";
  echo "<tr><th>ID</th><th>Name</th><th>Battery Capacity</th><th>Vehicle Number</th><th>Owner</th><th>Contact Number</th><th>Driver License Number</th></tr>";
  if ($vehicle_result->num_rows > 0) {
    while($row = $vehicle_result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["battery_capacity"]. "</td><td>" . $row["vehicle_number"]. "</td><td>" . $row["owner"]. "</td><td>" . $row["contact_number"]. "</td><td>" . $row["driver_license_number"]. "</td></tr>";
    }
  } else {
    echo "<tr><td colspan='7'>0 results</td></tr>";
  }
  echo "</table>";
  
  // Print battery table data in a table
  echo "<h2>Battery Information</h2>";
  echo "<form method='post'>";
  echo "<input type='text' name='battery_search_term' placeholder='Search battery table'>";
  echo "<input type='submit' name='battery_search' value='Search'>";
  echo "</form>";
  echo "<table>";
  echo "<tr><th>Name</th><th>Capacity</th><th>Purchase Date</th><th>Battery Health</th><th>Charge Cycle</th></tr>";
  if ($battery_result->num_rows > 0) {
    while($row = $battery_result->fetch_assoc()) {
      echo "<tr><td>" . $row["name"]. "</td><td>" . $row["capacity"]. "</td><td>" . $row["purchase_date"]. "</td><td>" . $row["battery_health"]. "</td><td>" . $row["charge_cycle"]. "</td><td>" . "</td></tr>";
      }
      } else {
      echo "<tr><td colspan='6'>0 results</td></tr>";
      }
      echo "</table>";
      
?>

      </body>
      </html>