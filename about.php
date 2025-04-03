<?php
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Mess Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .about-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('image/about-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #0d6efd;
        }
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #0d6efd;
        }
        .stats-section {
            background-color: #f8f9fa;
            padding: 50px 0;
        }
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .testimonial-card {
            border: none;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .testimonial-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1 class="display-4 mb-4">About Hostaler's Rasoi</h1>
            <p class="lead">Your Trusted Partner in Finding the Perfect Mess</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Our Mission</h2>
                    <p class="lead">To connect students and working professionals with quality mess services, making their daily lives easier and more convenient.</p>
                    <p>We understand the importance of good food and a comfortable living environment. Our platform bridges the gap between mess owners and potential customers, ensuring a seamless experience for both parties.</p>
                </div>
                <div class="col-lg-6">
                    <img src="image/mission.jpg" alt="Our Mission" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <i class="fas fa-search feature-icon"></i>
                        <h3>Easy Search</h3>
                        <p>Find messes based on location, price, and food preferences with our advanced search filters.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <i class="fas fa-star feature-icon"></i>
                        <h3>Verified Listings</h3>
                        <p>All messes on our platform are verified to ensure quality and reliability.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card text-center p-4">
                        <i class="fas fa-utensils feature-icon"></i>
                        <h3>Menu Management</h3>
                        <p>View daily menus and manage your food preferences easily.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <p>Messes Listed</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <p>Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <p>Cities Covered</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">4.8</div>
                        <p>Average Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Team</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="team-member">
                        <img src="image/profile1.jpg" alt="Pranav Sononi">
                        <h4>Pranav Sononi</h4>
                        <p class="text-muted">Lead Developer & Project Creator</p>
                        <p class="mt-3">A passionate computer science student who developed Hostaler's Rasoi as a college project to solve the real-world problem of finding quality mess services for students. With expertise in web development and a keen interest in creating user-friendly solutions, Pranav has built this platform to make hostel life easier for students across India.</p>
                        <div class="mt-4">
                            <a href="https://github.com/pranav7T" target="_blank" class="btn btn-outline-primary me-2"><i class="fab fa-github"></i> GitHub</a>
                            <a href="https://www.linkedin.com/in/pranav-sononi-4804782a2" target="_blank" class="btn btn-outline-primary me-2"><i class="fab fa-linkedin"></i> LinkedIn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">What Our Customers Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="mb-0">"Great platform! Found my perfect mess within minutes. The food quality is excellent and the service is reliable."</p>
                        <div class="testimonial-author">
                            <img src="image/testimonial1.jpg" alt="Customer">
                            <div>
                                <h6 class="mb-0">Sarah Williams</h6>
                                <small class="text-muted">Student</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="mb-0">"As a mess owner, this platform has helped me reach more customers. The management tools are very helpful."</p>
                        <div class="testimonial-author">
                            <img src="image/testimonial2.jpg" alt="Customer">
                            <div>
                                <h6 class="mb-0">Rajesh Kumar</h6>
                                <small class="text-muted">Mess Owner</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="mb-0">"The search filters are amazing. Found exactly what I was looking for. Highly recommended!"</p>
                        <div class="testimonial-author">
                            <img src="image/testimonial3.jpg" alt="Customer">
                            <div>
                                <h6 class="mb-0">David Chen</h6>
                                <small class="text-muted">Working Professional</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Have Questions?</h2>
            <p class="lead mb-4">We're here to help! Contact us for any queries or support.</p>
            <a href="contact.php" class="btn btn-primary btn-lg">Contact Us</a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
