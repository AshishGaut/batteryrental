<?php
require 'config.php';

// Fetch available vehicles
$sql = "SELECT vehicle_number FROM vehicle";
$result = mysqli_query($conn, $sql);

// Store vehicles in an array
$vehicles = array();
while ($row = mysqli_fetch_assoc($result)) {
  $vehicles[] = $row['vehicle_number'];
}

if (isset($_POST["submit"])) {
  $name = ($_POST["name"]);
  $capacity = htmlspecialchars($_POST["capacity"]);
  $purchase_date = htmlspecialchars($_POST["purchase_date"]);
  $battery_health = htmlspecialchars($_POST["battery_health"]);
  $charge_cycle = htmlspecialchars($_POST["charge_cycle"]);
  $sql = "INSERT INTO battery (name, capacity, purchase_date, battery_health, charge_cycle) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sdsds', $name, $capacity, $purchase_date, $battery_health, $charge_cycle);
$res = mysqli_stmt_execute($stmt);

  if($res){
    echo "Record inserted successfully.";
  } else{
    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
  }
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add battery</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Battery Form</title>
</head>
<body>



	<form action="addbattery.php" method="POST">
		<label for="name">Battery Name:</label>
		<input type="text" id="name" name="name"><br><br>
		
		<label for="capacity">Capacity:</label>
		<input type="number" id="capacity" name="capacity"><br><br>
		
		<label for="purchase_date">Purchase Date:</label>
		<input type="date" id="purchase_date" name="purchase_date"><br><br>
		
		<label for="battery_health">Battery Health:</label>
		<input type="number" id="battery_health" name="battery_health" step="0.01"><br><br>
		
		<label for="charge_cycle">Charge Cycle:</label>
		<input type="number" id="charge_cycle" name="charge_cycle"><br><br>
		
		<button type="submit" name="submit">save</button>
	</form>
</body>
</html>

</body>
</html>
