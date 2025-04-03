<?php
include '../includes/db_connect.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'];

$query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
mysqli_query($conn, $query);

header("Location: login.php");
?>
