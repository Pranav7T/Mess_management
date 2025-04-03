<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hosteler’s Rasoi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Header -->
<header class="bg-primary p-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="index.php">Hosteler’s Rasoi</a>

            <!-- Toggle Button for Small Screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links & Search Bar -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="auth/login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="admin/admin_login.php" class="nav-link">Admin</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                    <a href="auth/logout.php" class="btn ">Logout</a>

                </ul>

                <!-- Search Bar -->
                <form method="GET" action="index.php" class="d-flex mt-2 mt-lg-0">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search Mess">
                    <button type="submit" class="btn btn-light">🔍</button>
                </form>
            </div>
        </nav>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
