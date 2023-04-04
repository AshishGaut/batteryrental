<!DOCTYPE html>
<html>
<head>
	<title>Vehicle Form</title>
</head>
<body>
<?php
	require 'config.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = htmlspecialchars($_POST['name']);
		$battery_capacity = htmlspecialchars($_POST['battery_capacity']);
		$vehicle_number = htmlspecialchars($_POST['vehicle_number']);
		$owner = htmlspecialchars($_POST['owner']);
		$contact_number = htmlspecialchars($_POST['contact_number']);
		$driver_license_number = htmlspecialchars($_POST['driver_license_number']);
		$sql = 'INSERT INTO vehicle (name, battery_capacity, vehicle_number, owner, contact_number, driver_license_number) VALUES (?, ?, ?, ?, ?, ?)';
		if($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, 'sdssss', $name, $battery_capacity, $vehicle_number, $owner, $contact_number, $driver_license_number);
			if(mysqli_stmt_execute($stmt)) {
				echo 'Records created successfully.';
			} else {
				echo 'Error: ' . htmlspecialchars(mysqli_error($conn));
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
?>
<h2>Add Vehicle</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<div>
		<label>Name:</label>
		<input type="text" name="name" required>
	</div>
	<div>
		<label>Battery Capacity:</label>
		<input type="number" name="battery_capacity" min="0" step="0.01" required>
	</div>
	<div>
		<label>Vehicle Number:</label>
		<input type="text" name="vehicle_number" required>
	</div>
	<div>
		<label>Owner:</label>
		<input type="text" name="owner" required>
	</div>
	<div>
		<label>Contact Number:</label>
		<input type="tel" name="contact_number" required>
	</div>
	<div>
		<label>Driver License Number:</label>
		<input type="text" name="driver_license_number" required>
	</div>
	<div>
		<input type="submit" value="Submit">
	</div>
</form>
</body>
</html>