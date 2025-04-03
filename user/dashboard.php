<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'user') {
    header("Location: ../login.php");
    exit();
}

include '../includes/db_connect.php';

// Get user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Hostaler's Rasoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .dashboard-card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .profile-section {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Hostaler's Rasoi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="profile-section">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="../image/default-avatar.png" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="col-md-10">
                    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
                    <p class="text-muted">Member since <?php echo date('F Y', strtotime($user['created_at'])); ?></p>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="row">
            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Quick Actions</h4>
                    <div class="list-group">
                        <a href="search_mess.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-search me-2"></i> Find a Mess
                        </a>
                        <a href="bookings.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-check me-2"></i> My Bookings
                        </a>
                        <a href="reviews.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-star me-2"></i> My Reviews
                        </a>
                        <a href="profile.php" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-md-8">
                <div class="dashboard-card">
                    <h4>Recent Activity</h4>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Welcome to Hostaler's Rasoi!</h5>
                                <small class="text-muted">Just now</small>
                            </div>
                            <p class="mb-1">Start exploring messes near you and make your first booking.</p>
                        </div>
                    </div>
                </div>

                <!-- Recommended Messes -->
                <div class="dashboard-card mt-4">
                    <h4>Recommended Messes</h4>
                    <div class="row">
                        <?php
                        // Fetch recommended messes
                        $stmt = $conn->prepare("SELECT * FROM messes ORDER BY rating DESC LIMIT 3");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        while ($mess = $result->fetch_assoc()) {
                            echo '
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <img src="../image/' . htmlspecialchars($mess['image']) . '" class="card-img-top" alt="Mess Image" style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($mess['name']) . '</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-star text-warning"></i> ' . number_format($mess['rating'], 1) . '
                                                <br>
                                                <i class="fas fa-rupee-sign"></i> ' . htmlspecialchars($mess['price']) . '
                                            </small>
                                        </p>
                                        <a href="../view_mess.php?id=' . $mess['id'] . '" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 