<?php
$hashed_password = password_hash('admin123', PASSWORD_BCRYPT);
echo $hashed_password; // Copy and use in the SQL query below
?>
