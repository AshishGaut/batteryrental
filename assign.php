<!DOCTYPE html>
<html>
<head>
	<title>Assign Battery to Vehicle</title>
</head>
<body>

<?php
include 'config.php';
// Check if form is submitted
if (isset($_POST["vehicle_number"]) && isset($_POST["battery_name"])) {
    // Retrieve selected vehicle and battery
    $vehicle_number = $_POST["vehicle_number"];
    $battery_name = $_POST["battery_name"];

    // Insert new battery assignment record into battery_history table
    $query = "INSERT INTO battery_history (battery_name, vehicle_number) VALUES ('$battery_name', '$vehicle_number')";

    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    // Update battery_health and charge_cycle in battery table
    $query = "UPDATE battery SET battery_health = 100, charge_cycle = charge_cycle + 1 WHERE name = '$battery_name'";
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    // Update battery_capacity in vehicle table
    $query = "UPDATE vehicle SET battery_capacity = (SELECT capacity FROM battery WHERE name = '$battery_name') WHERE vehicle_number = '$vehicle_number'";
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    echo "<p>Battery $battery_name has been assigned to vehicle $vehicle_number.</p>";
}

if (isset($_POST["unassign_battery"]) && isset($_POST["battery_name"])) {
    // Retrieve selected battery name
    $battery_name = $_POST["battery_name"];

    // Delete battery assignment record from battery_history table
    $query = "DELETE FROM battery_history WHERE battery_name = '$battery_name'";
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    // Update battery_capacity in vehicle table
    $query = "UPDATE vehicle SET battery_capacity = NULL WHERE battery_capacity = (SELECT capacity FROM battery WHERE name = '$battery_name')";
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn);
    }

    echo "<p>Battery $battery_name has been unassigned.</p>";
}


?>
<h2>Assigned Vehicles</h2>
<table>
	<thead>
		<tr>
			<th>Vehicle Number</th>
			<th>Battery Name</th>
		</tr>
	</thead>
	<tbody>
		<?php
		// Retrieve list of assigned vehicles and their batteries
		$query = "SELECT vehicle.vehicle_number, battery_history.battery_name FROM vehicle INNER JOIN battery_history ON vehicle.vehicle_number = battery_history.vehicle_number";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>" . $row["vehicle_number"] . "</td><td>" . $row["battery_name"] . "</td><td><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'><input type='hidden' name='battery_name' value='" . $row["battery_name"] . "'><button type='submit' name='unassign_battery'>Unassign Battery</button></form></td></tr>";

		}
		?>
	</tbody>
</table>

<h1>Assign Battery to Vehicle</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="vehicle_number">Select a vehicle:</label>
	<select name="vehicle_number" required>
    <option value="">-- Select a vehicle --</option>
    <?php
    // Retrieve list of unassigned vehicles
    $query = "SELECT vehicle_number FROM vehicle WHERE vehicle_number NOT IN (SELECT vehicle_number FROM battery_history)";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row["vehicle_number"] . "'>" . $row["vehicle_number"] . "</option>";
    }
    ?>
</select>

	<br>
	<br>
	<br>
	<label for="battery_name">Select an unassigned battery:</label>
	<select name="battery_name" required>
		<option value="">-- Select an unassigned battery --</option>
		<?php
		// Retrieve list of unassigned batteries
		$query = "SELECT name FROM battery WHERE name NOT IN (SELECT battery_name FROM battery_history)";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
		}
		?>
	</select>
	<br>
	<input type="submit" value="Assign Battery">
</form>



</body>
</html>
