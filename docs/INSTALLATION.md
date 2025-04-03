# Quick Installation Guide

## Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx web server
- XAMPP/WAMP/LAMP (recommended for local setup)

## Setup Steps

1. **Place files in web directory**
   - Extract all files to your web server directory (e.g., `htdocs` folder in XAMPP)

2. **Configure Database**
   - Create a new MySQL database named `mess_management`
   - Import the included `mess_finder.sql` file

3. **Configure Application**
   - Copy `config.sample.php` to `config.php`
   - Update database credentials in `config.php`

4. **Set Permissions**
   - Ensure the `uploads` directory is writable by the web server

5. **Access the Application**
   - Open your browser and navigate to: http://localhost/Mess_management/

## Default Login
- **Admin**: admin@gmail.com 
   Password: admin123
- Change this password immediately after login!

## Need Help?
- See full documentation in the `docs` folder
- Contact: support@hostalersrasoi.com 