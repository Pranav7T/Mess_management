<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            padding: 40px 20px;
        }
        .card {
            border-radius: 10px;
            transition: 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        <a href="../index.php" class="btn btn-danger">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container dashboard-container text-center">
        <h2 class="mb-4">Welcome, Admin!</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <a href="manage_messes.php" class="btn btn-success w-100">Manage Mess Listings</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <a href="manage_users.php" class="btn btn-info w-100">Manage Users</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <a href="manage_reviews.php" class="btn btn-warning w-100">Manage Reviews</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <a href="website_report.php" class="btn btn-secondary w-100">Generate Report</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
