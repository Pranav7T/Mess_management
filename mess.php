<?php
require_once 'includes/db_connect.php';

// Get mess ID from URL
$mess_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($mess_id <= 0) {
    die("Invalid mess ID");
}

// Fetch mess details
$stmt = $conn->prepare("SELECT * FROM mess WHERE id = ?");
$stmt->bind_param("i", $mess_id);
$stmt->execute();
$result = $stmt->get_result();
$mess = $result->fetch_assoc();

if (!$mess) {
    die("Mess not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($mess['name']); ?> - Mess Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .mess-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .mess-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .mess-image {
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .mess-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .mess-details p {
            margin: 10px 0;
            color: #333;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .menu-link {
            display: inline-block;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="mess-container">
        <a href="index.php" class="back-link">← Back to Homepage</a>

        <div class="mess-header">
            <h1><?php echo htmlspecialchars($mess['name']); ?></h1>
            <img src="image/<?php echo htmlspecialchars($mess['image']); ?>" alt="<?php echo htmlspecialchars($mess['name']); ?>" class="mess-image">
        </div>

        <div class="mess-details">
            <p>📍 Location: <?php echo htmlspecialchars($mess['location']); ?></p>
            <p>📞 Contact: <?php echo htmlspecialchars($mess['contact']); ?></p>
            <p>🍽 Food Type: <?php echo htmlspecialchars($mess['veg_nonveg']); ?></p>
            <p>💰 Price: ₹<?php echo htmlspecialchars($mess['price']); ?></p>
            <p>⏰ Open Time: <?php echo htmlspecialchars($mess['open_time']); ?></p>
            <p>⭐ Rating: <?php echo number_format($mess['rating'], 1); ?>/5</p>
            
            <a href="view_menu.php?id=<?php echo $mess_id; ?>" class="menu-link">View Menu</a>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
