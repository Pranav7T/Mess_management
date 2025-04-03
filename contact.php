<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mess | contact</title>
    <link rel="stylesheet" href="contact_style.css">
    <link rel="stylesheet" href="atyles.css">
</head>
<body>


<?php include 'includes/header.php'; ?>  <!-- Include Header -->

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>We’d love to hear from you! Feel free to reach out to us.</p>

    <div class="contact-info">
        <p>📍 Address: XYZ Road, Hostel Area, Your City, India</p>
        <p>📞 Phone: +91 9876543210</p>
        <p>📧 Email: support@hostelersrasoi.com</p>
    </div>

    <h3>Send Us a Message</h3>
    <form action="contact_process.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>  <!-- Include Footer -->
</body>
</html>

