<?php
include '../includes/db_connect.php';

// Fetch all messages
$result = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM contact_messages WHERE id = $id");
    header("Location: manage_reviews.php");
}

// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_submit'])) {
    $id = $_POST['message_id'];
    $reply = $conn->real_escape_string($_POST['reply']);

    $conn->query("UPDATE contact_messages SET reply = '$reply' WHERE id = $id");
    header("Location: manage_reviews.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center mb-4">User Reviews</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Reply</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td>
                                <!-- Display previous reply -->
                                <?php if (!empty($row['reply'])) { ?>
                                    <p class="text-success"><?php echo nl2br(htmlspecialchars($row['reply'])); ?></p>
                                <?php } else { ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                                        <textarea name="reply" class="form-control mb-2" rows="2" required placeholder="Type your reply here..."></textarea>
                                        <button type="submit" name="reply_submit" class="btn btn-primary btn-sm">Send Reply</button>
                                    </form>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this review?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
