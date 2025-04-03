<?php
session_start();
require_once '../includes/db_connect.php';

// Check if user is logged in and is a mess owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'owner') {
    header('Location: ../auth/login.php');
    exit();
}

// Get menu item ID and mess ID from URL
$menu_item_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$mess_id = isset($_GET['mess_id']) ? (int)$_GET['mess_id'] : 0;

if ($menu_item_id <= 0 || $mess_id <= 0) {
    header('Location: dashboard_owner.php');
    exit();
}

// Verify that the menu item belongs to the mess owned by the logged-in owner
$owner_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT m.id FROM mess m 
                       JOIN menu_items mi ON m.id = mi.mess_id 
                       WHERE m.owner_id = ? AND m.id = ? AND mi.id = ?");
$stmt->bind_param("iii", $owner_id, $mess_id, $menu_item_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: dashboard_owner.php');
    exit();
}

// Delete the menu item
$stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $menu_item_id);

if ($stmt->execute()) {
    header("Location: manage_menu.php?id=" . $mess_id);
} else {
    header("Location: manage_menu.php?id=" . $mess_id . "&error=Failed to delete menu item");
}
exit(); 