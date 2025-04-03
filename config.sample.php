<?php
/**
 * Configuration File Template
 * 
 * Copy this file to 'config.php' and update the values as needed
 * DO NOT commit the actual config.php file to version control
 */

// Database Configuration
define('DB_HOST', 'localhost');      // Database host (usually localhost)
define('DB_NAME', 'mess_management'); // Database name
define('DB_USER', 'root');           // Database username
define('DB_PASS', '');               // Database password
define('DB_PORT', '3306');           // Database port (MySQL default: 3306)

// Site Configuration
define('SITE_URL', 'http://localhost/Mess_management/'); // Site URL with trailing slash
define('SITE_NAME', 'Hostaler\'s Rasoi');                // Site name
define('ADMIN_EMAIL', 'admin@example.com');              // Admin email for notifications

// Security Configuration
define('CSRF_TOKEN_EXPIRY', 3600);   // CSRF token expiry time in seconds
define('SESSION_LIFETIME', 86400);   // Session lifetime in seconds (default: 24 hours)
define('PASSWORD_PEPPER', 'change_this_to_random_string'); // Additional security for password hashing

// File Upload Configuration
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // Maximum file size for uploads (5MB)
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']); // Allowed file extensions
define('UPLOAD_PATH', 'uploads/');   // Path for file uploads (relative to site root)

// API Keys (if using any external services)
define('GOOGLE_MAPS_API_KEY', '');   // For location services
define('SMS_API_KEY', '');           // For SMS notifications
define('PAYMENT_GATEWAY_KEY', '');   // For payment processing

// Debug Mode (set to false in production)
define('DEBUG_MODE', true);          // Enable/disable debug information

// Timezone settings
define('TIMEZONE', 'Asia/Kolkata');  // Default timezone for the application 