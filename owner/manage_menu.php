<?php
session_start();
require_once '../includes/db_connect.php';

// Check if user is logged in and is a mess owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'owner') {
    header('Location: ../auth/login.php');
    exit();
}

// Get mess ID from URL
$mess_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($mess_id <= 0) {
    header('Location: dashboard_owner.php');
    exit();
}

// Verify that the mess belongs to the logged-in owner
$owner_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, name FROM mess WHERE id = ? AND owner_id = ?");
$stmt->bind_param("ii", $mess_id, $owner_id);
$stmt->execute();
$result = $stmt->get_result();
$mess = $result->fetch_assoc();

if (!$mess) {
    header('Location: dashboard_owner.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $meal_type = $_POST['meal_type'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Debug information
    error_log("Adding menu item: mess_id=$mess_id, day=$day, meal_type=$meal_type, item_name=$item_name");

    $stmt = $conn->prepare("INSERT INTO menu_items (mess_id, day, meal_type, item_name, description, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssd", $mess_id, $day, $meal_type, $item_name, $description, $price);
    
    if ($stmt->execute()) {
        $success = "Menu item added successfully!";
        // Refresh the page to show the new item
        header("Location: manage_menu.php?id=" . $mess_id);
        exit();
    } else {
        $error = "Error adding menu item: " . $conn->error;
    }
}

// Get existing menu items
$stmt = $conn->prepare("SELECT * FROM menu_items WHERE mess_id = ? ORDER BY day, meal_type");
$stmt->bind_param("i", $mess_id);
$stmt->execute();
$menu_items = $stmt->get_result();

// Debug information
error_log("Retrieved " . $menu_items->num_rows . " menu items for mess_id=$mess_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - <?php echo htmlspecialchars($mess['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .menu-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
        }
        .menu-form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .menu-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #333;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .delete-btn {
            color: #dc3545;
            text-decoration: none;
            margin-left: 10px;
        }
        .delete-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand">Hostaler's Rasoi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <a href="dashboard_owner.php" class="me-3 text-white">Dashboard</a>
                <a href="../index.php" class="me-3 text-white">Home</a>
                <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="menu-container">
        <a href="dashboard_owner.php" class="back-link">← Back to Dashboard</a>
        <h1>Manage Menu - <?php echo htmlspecialchars($mess['name']); ?></h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">Add New Menu Item</div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="day">Day:</label>
                            <select name="day" class="form-select" required>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="meal_type">Meal Type:</label>
                            <select name="meal_type" class="form-select" required>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="item_name">Item Name:</label>
                            <input type="text" name="item_name" class="form-control" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price">Price (₹):</label>
                            <input type="number" name="price" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Add Menu Item</button>
                </form>
            </div>
        </div>

        <h2>Current Menu Items</h2>
        <?php if ($menu_items->num_rows > 0): ?>
            <div class="menu-items">
                <?php while ($item = $menu_items->fetch_assoc()): ?>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['item_name']); ?></h5>
                            <p class="card-text"><strong>Day:</strong> <?php echo htmlspecialchars($item['day']); ?></p>
                            <p class="card-text"><strong>Meal Type:</strong> <?php echo htmlspecialchars($item['meal_type']); ?></p>
                            <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text"><strong>Price:</strong> ₹<?php echo number_format($item['price'], 2); ?></p>
                            <a href="delete_menu_item.php?id=<?php echo $item['id']; ?>&mess_id=<?php echo $mess_id; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No menu items added yet. Add your first menu item using the form above.
            </div>
        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 