<?php
include("../includes/db_connect.php");

// Get mess ID from URL
if (isset($_GET['id'])) {
    $mess_id = $_GET['id'];

    // Fetch mess details
    $query = "SELECT * FROM mess WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $mess_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $mess = $result->fetch_assoc();
} else {
    echo "Invalid request!";
    exit;
}

// Update mess details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $location = $_POST["location"];
    $open_time = $_POST["open_time"];
    $price = $_POST["price"];
    $contact = $_POST["contact"];
    $veg_nonveg = $_POST["veg_nonveg"];

    $update_query = "UPDATE mess SET name=?, rating=?, location=?, open_time=?, price=?, contact=?, veg_nonveg=? WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sdsssssi", $name, $rating, $location, $open_time, $price, $contact, $veg_nonveg, $mess_id);

    if ($stmt->execute()) {
        echo "<script>alert('Mess details updated successfully!'); window.location.href='dashboard_owner.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Mess</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4>Edit Mess Details</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $mess['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating:</label>
                    <input type="number" step="0.1" name="rating" class="form-control" value="<?php echo $mess['rating']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location:</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $mess['location']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Opening Time:</label>
                    <input type="text" name="open_time" class="form-control" value="<?php echo $mess['open_time']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price:</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $mess['price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact:</label>
                    <input type="text" name="contact" class="form-control" value="<?php echo $mess['contact']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type:</label>
                    <select name="veg_nonveg" class="form-select" required>
                        <option value="Veg" <?php echo ($mess['veg_nonveg'] == 'Veg') ? 'selected' : ''; ?>>Veg</option>
                        <option value="Non-Veg" <?php echo ($mess['veg_nonveg'] == 'Non-Veg') ? 'selected' : ''; ?>>Non-Veg</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Update Mess</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
