<?php
require_once 'includes/db_connect.php';

// Get mess ID from URL parameter
$mess_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($mess_id <= 0) {
    die("Invalid mess ID");
}

// Get mess details
$stmt = $conn->prepare("SELECT * FROM mess WHERE id = ?");
$stmt->bind_param("i", $mess_id);
$stmt->execute();
$result = $stmt->get_result();
$mess = $result->fetch_assoc();

if (!$mess) {
    die("Mess not found");
}

// Get menu items grouped by day and meal type
$stmt = $conn->prepare("SELECT * FROM menu_items WHERE mess_id = ? ORDER BY day, meal_type");
$stmt->bind_param("i", $mess_id);
$stmt->execute();
$menu_items = $stmt->get_result();

// Debug information
error_log("Retrieved " . $menu_items->num_rows . " menu items for mess_id=$mess_id");

// Group menu items by day and meal type
$menu_by_day = [];
while ($item = $menu_items->fetch_assoc()) {
    $day = $item['day'];
    $meal_type = $item['meal_type'];
    if (!isset($menu_by_day[$day])) {
        $menu_by_day[$day] = [];
    }
    if (!isset($menu_by_day[$day][$meal_type])) {
        $menu_by_day[$day][$meal_type] = [];
    }
    $menu_by_day[$day][$meal_type][] = $item;
}

// Debug information
error_log("Grouped menu items into " . count($menu_by_day) . " days");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - <?php echo htmlspecialchars($mess['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .menu-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }
        .mess-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .mess-header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .mess-info {
            color: #666;
            margin-bottom: 20px;
        }
        .menu-section {
            margin-bottom: 40px;
        }
        .day-header {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }
        .meal-type {
            margin-bottom: 20px;
        }
        .meal-type h3 {
            color: #444;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #dee2e6;
        }
        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
        .menu-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .menu-item:hover {
            transform: translateY(-5px);
        }
        .menu-item h4 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .menu-item p {
            margin: 5px 0;
            color: #666;
        }
        .price {
            color: #198754;
            font-weight: bold;
            font-size: 1.1em;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            transition: background-color 0.2s;
        }
        .back-button:hover {
            background: #0b5ed7;
            color: white;
        }
        .no-menu {
            text-align: center;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
            color: #666;
        }
    </style>
</head>
<body class="bg-light">
    <?php include 'includes/header.php'; ?>

    <div class="menu-container">
        <a href="mess.php?id=<?php echo $mess_id; ?>" class="back-button">← Back to Mess Details</a>

        <div class="mess-header">
            <h1><?php echo htmlspecialchars($mess['name']); ?></h1>
            <div class="mess-info">
                <p>📍 Location: <?php echo htmlspecialchars($mess['location']); ?></p>
                <p>📞 Contact: <?php echo htmlspecialchars($mess['contact']); ?></p>
                <p>🍽 Type: <?php echo htmlspecialchars($mess['veg_nonveg']); ?></p>
            </div>
        </div>

        <?php if (empty($menu_by_day)): ?>
            <div class="no-menu">
                <h3>No menu available yet</h3>
                <p>This mess hasn't added their menu yet. Please check back later.</p>
            </div>
        <?php else: ?>
            <?php 
            // Define the order of days
            $days_order = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            
            // Sort the menu items by day order
            uksort($menu_by_day, function($a, $b) use ($days_order) {
                return array_search($a, $days_order) - array_search($b, $days_order);
            });
            
            foreach ($menu_by_day as $day => $meals): 
            ?>
                <div class="menu-section">
                    <div class="day-header">
                        <h2><?php echo htmlspecialchars($day); ?></h2>
                    </div>

                    <?php 
                    // Define the order of meal types
                    $meal_types_order = ['Breakfast', 'Lunch', 'Dinner'];
                    
                    // Sort the meal types
                    uksort($meals, function($a, $b) use ($meal_types_order) {
                        return array_search($a, $meal_types_order) - array_search($b, $meal_types_order);
                    });
                    
                    foreach ($meals as $meal_type => $items): 
                    ?>
                        <div class="meal-type">
                            <h3><?php echo htmlspecialchars($meal_type); ?></h3>
                            <div class="menu-items">
                                <?php foreach ($items as $item): ?>
                                    <div class="menu-item">
                                        <h4><?php echo htmlspecialchars($item['item_name']); ?></h4>
                                        <?php if ($item['description']): ?>
                                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                                        <?php endif; ?>
                                        <p class="price">₹<?php echo number_format($item['price'], 2); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 