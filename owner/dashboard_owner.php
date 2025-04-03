<?php
session_start();
include("../includes/db_connect.php");

// Check if the user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'owner') {
    header("Location: ../auth/login.php");
    exit;
}

$owner_id = $_SESSION['user_id'];

// Handle Add Mess Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $open_time = $_POST['open_time'];
    $price = $_POST['price'];
    $contact = $_POST['contact'];
    $veg_nonveg = $_POST['veg_nonveg'];

    $sql = "INSERT INTO mess (owner_id, name, rating, city,location, open_time, price, contact, veg_nonveg)
            VALUES ('$owner_id', '$name', '$rating', '$city','$location', '$open_time', '$price', '$contact', '$veg_nonveg')";

    if ($conn->query($sql) === TRUE) {
        $success = "Mess added successfully!";
        header("Location: dashboard_owner.php");
        exit;
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Fetch messes added by the logged-in owner
$result = $conn->query("SELECT * FROM mess WHERE owner_id = '$owner_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Owner Dashboard - Mess Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            padding: 10px 20px;
        }
        .container {
            max-width: 900px;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn-menu {
            background-color: #6c757d;
            color: white;
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
            <a href="../index.php"><h6>Home</h6></a>
            <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center">Manage Your Messes</h2>

    <!-- Success/Error Messages -->
    <?php if (isset($success)) echo "<div class='alert alert-success text-center'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

    <!-- Add New Mess Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">Add New Mess</div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Mess Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="number" step="0.1" name="rating" class="form-control" placeholder="Rating (0-5)" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="city" class="form-control" placeholder="City" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="location" class="form-control" placeholder="Location Address" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="open_time" class="form-control" placeholder="Opening Hours" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="price" class="form-control" placeholder="Price (e.g. ₹2000/month)" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <select name="veg_nonveg" class="form-select">
                            <option value="Veg">Veg</option>
                            <option value="Non-Veg">Non-Veg</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Add Mess</button>
            </form>
        </div>
    </div>

    <!-- Display Messes -->
    <h3 class="text-center">Your Mess Listings</h3>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><strong>Rating:</strong> <?php echo $row['rating']; ?> ⭐</p>
                        <p class="card-text"><strong>City:</strong> <?php echo $row['city']; ?></p>
                        <p class="card-text"><strong>Location:</strong> <?php echo $row['location']; ?></p>
                        <p class="card-text"><strong>Open:</strong> <?php echo $row['open_time']; ?></p>
                        <p class="card-text"><strong>Price:</strong> <?php echo $row['price']; ?></p>
                        <p class="card-text"><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                        <p class="card-text"><strong>Type:</strong> <?php echo $row['veg_nonveg']; ?></p>
                        <div class="action-buttons">
                            <a href="manage_menu.php?id=<?php echo $row['id']; ?>" class="btn btn-menu btn-sm">Manage Menu</a>
                            <a href="edit_mess.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_mess.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
