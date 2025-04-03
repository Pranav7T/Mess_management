<?php
include '../db_connect.php';
session_start();

if ($_SESSION['role'] != 'owner') {
    echo "Access Denied!";
    exit();
}

$owner_id = $_SESSION['user_id'];
$mess_name = $_POST['mess_name'];
$city = $_POST['city'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$price = $_POST['price'];
$open_time = $_POST['open_time'];

$query = "INSERT INTO mess_listings (owner_id, mess_name, city, address, contact, price, open_time)
          VALUES ('$owner_id', '$mess_name', '$city', '$address', '$contact', '$price', '$open_time')";
mysqli_query($conn, $query);

header("Location: dashboard.php");
?>
