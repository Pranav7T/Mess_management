<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4 shadow" style="width: 350px;">
            <h3 class="text-center">Admin Login</h3>
            
            <?php
            session_start();
            require '../includes/db_connect.php'; // Include database connection

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                if (!empty($username) && !empty($password)) {
                    $query = "SELECT * FROM admin WHERE username = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $admin = $result->fetch_assoc();

                    if ($admin && $password === $admin['password']) { // Direct password check (For testing)
                        $_SESSION['admin'] = $admin['username'];
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Invalid username or password.</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Please fill in all fields.</div>";
                }
            }
            ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">Return <a href="../index.php">Home</a></p>
            </form>
        </div>
    </div>
</body>
</html>
