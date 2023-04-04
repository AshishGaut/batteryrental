<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connection unsuccessful";
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected to server successfully </br>";

