<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "mess_finder");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messes from database
$sql = "SELECT * FROM mess";
$result = $conn->query($sql);
?>
