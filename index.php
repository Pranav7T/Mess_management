<?php
session_start();
// If user is already logged in, redirect to appropriate dashboard
if(isset($_SESSION['user_id'])) {
    if($_SESSION['user_type'] == 'owner') {
        header("Location: owner/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit();
}

include 'includes/db_connect.php'; // Database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostaler's Rasoi - Find Your Perfect Mess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('image/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 150px 0;
            text-align: center;
        }
        .feature-card {
            border: none;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 20px;
        }
        .cta-section {
            background-color: #f8f9fa;
            padding: 80px 0;
        }
        .user-type-card {
            border: none;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .user-type-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Hostaler's Rasoi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">Find Your Perfect Mess</h1>
            <p class="lead mb-4">Discover quality mess services near you with just a few clicks</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="search.php" method="GET" class="d-flex">
                        <input type="text" class="form-control me-2" name="location" placeholder="Enter your location">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-search feature-icon"></i>
                        <h3>Easy Search</h3>
                        <p>Find messes based on location, food preferences, and budget</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-star feature-icon"></i>
                        <h3>Verified Listings</h3>
                        <p>All messes are verified to ensure quality and reliability</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-utensils feature-icon"></i>
                        <h3>Menu Management</h3>
                        <p>View daily menus and manage your food preferences</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="text-center mb-5">Join Us Today</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="user-type-card">
                        <i class="fas fa-user feature-icon"></i>
                        <h3>Looking for a Mess?</h3>
                        <p>Find quality mess services near you with our easy-to-use platform</p>
                        <a href="register.php?type=user" class="btn btn-primary">Register as User</a>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="user-type-card">
                        <i class="fas fa-store feature-icon"></i>
                        <h3>Mess Owner?</h3>
                        <p>List your mess and reach more customers</p>
                        <a href="register.php?type=owner" class="btn btn-primary">Register as Owner</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Hostaler's Rasoi helps students and working professionals find quality mess services in their area.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="text-white">About</a></li>
                        <li><a href="contact.php" class="text-white">Contact</a></li>
                        <li><a href="privacy.php" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: support@hostalersrasoi.com<br>
                    Phone: +91 9876543210</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


