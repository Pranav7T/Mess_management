<?php
include("../includes/db_connect.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'owner') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM mess WHERE id = '$id'");
}

header("Location: dashboard_owner.php");
?>
