<?php
include '../includes/db_connect.php';

// Fetch total users
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];

// Fetch total mess listings
$totalMesses = $conn->query("SELECT COUNT(*) AS count FROM mess")->fetch_assoc()['count'];

// Fetch total reviews
//$totalReviews = $conn->query("SELECT COUNT(*) AS count FROM reviews")->fetch_assoc()['count'];

// Fetch total contact form submissions
//$totalContacts = $conn->query("SELECT COUNT(*) AS count FROM contact")->fetch_assoc()['count'];

// Fetch most searched city
$topCity = $conn->query("SELECT city, COUNT(city) AS count FROM mess GROUP BY city ORDER BY count DESC LIMIT 1")->fetch_assoc();

// Fetch most visited mess

// Fetch latest mess listings
$newMesses = $conn->query("SELECT name, city, created_at FROM mess ORDER BY created_at DESC LIMIT 5");

// Fetch latest user signups
$newUsers = $conn->query("SELECT name, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website Activity Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-4">
    <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        <h2 class="text-center">📊 Website Activity Report</h2>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-info text-white text-center p-3">
                    <h4>Total Users</h4>
                    <h2><?php echo $totalUsers; ?></h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white text-center p-3">
                    <h4>Total Mess Listings</h4>
                    <h2><?php echo $totalMesses; ?></h2>
                </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-3">
                    <h4>📌 Most Searched City</h4>
                    <p><strong><?php echo $topCity ? $topCity['city'] : 'No data'; ?></strong> (<?php echo $topCity ? $topCity['count'] : '0'; ?> searches)</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h4>🔥 Most Visited Mess</h4>
                    <p><strong><?php echo $mostVisitedMess ? $mostVisitedMess['name'] : 'No data'; ?></strong> (Visited: <?php echo $mostVisitedMess ? $mostVisitedMess['visit_count'] : '0'; ?> times)</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h4>🆕 Latest Mess Listings</h4>
            <ul>
                <?php while ($mess = $newMesses->fetch_assoc()) { ?>
                    <li><strong><?php echo $mess['name']; ?></strong> (<?php echo $mess['city']; ?>) - Added on <?php echo $mess['created_at']; ?></li>
                <?php } ?>
            </ul>
        </div>

        <div class="mt-4">
            <h4>📅 Latest User Signups</h4>
            <ul>
                <?php while ($user = $newUsers->fetch_assoc()) { ?>
                    <li><?php echo $user['name']; ?> (<?php echo $user['email']; ?>) - Joined on <?php echo $user['created_at']; ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="text-center mt-4">
    <a href="generate_pdf.php" class="btn btn-danger">Download PDF 📄</a>
    <a href="generate_excel.php" class="btn btn-success">Download Excel 📊</a>
            </div>
            <a href="" class="btn btn-secondary mt-3"></a>
            </div>
    </div>
    <div>

    </div>
</div>

</body>
</html>
