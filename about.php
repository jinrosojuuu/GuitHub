<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitHub - About</title>
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chatbot.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="img/logo.png" alt="Guitar Icon" class="logo">
            <a href="#">Guit<span style="color: #FF6B00;">Hub.</span></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="" class="active">About</a></li>
        </ul>
        <a href="admin.php" class="admin-btn">
            <img src="img/settings.svg" alt="Settings icon" class="admin-icon">
            Admin
        </a>
        <!-- Hamburger injected by script.js -->
    </nav>

    <section class="about-header">
        <div class="about-hero">
            <h1>About Guit<span style="color: #FF6B00;">Hub.</span></h1>
            <p>Your trusted partner in finding the perfect guitar since 2026.</p>
            <p>We're passionate about music and dedicated to helping you find your sound.</p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="story">
        <div class="story-content">
            <h1>Our Story</h1>
            <p>
                GuitHub was founded by a group of musicians and aspiring developers from a university.
                We started this as a small idea that eventually grown into one of the most trusted guitar retailers in the country.
            </p>
            <p>
                We believe that the right guitar can inspire creativity and unlock your musical
                potential. That's why we carefully curate every instrument in our collection,
                ensuring quality and value.
            </p>
            <p>
                Our team of expert musicians and luthiers are here to guide you through your
                journey, whether you're picking up a guitar for the first time or adding to your
                professional collection.
            </p>
        </div>
        <div class="story-image">
            <img src="img/soju.jpg" alt="jinro">
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="choose-section">
        <h2>Why Choose Us</h2>
        <div class="features-grid">

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="img/staff.svg" alt="Expert Staff">
                </div>
                <h3>Expert Staff</h3>
                <p>
                    Our team includes professional musicians,
                    luthiers, and gear enthusiasts who are
                    passionate about helping you find the
                    perfect instrument.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="img/quality.svg" alt="Quality Guaranteed">
                </div>
                <h3>Quality Guaranteed</h3>
                <p>
                    Every guitar is inspected, set up, and tested
                    by our team before it ships. We stand behind
                    every instrument we sell with our warranty.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <img src="img/clock.svg" alt="Fast Service">
                </div>
                <h3>Fast Service</h3>
                <p>
                    From browsing to delivery, we make the
                    process smooth and quick. Most orders ship
                    within 24 hours with free shipping on
                    orders over ₱500.
                </p>
            </div>

        </div>
    </section>

    <!-- Visit Us Section -->
    <section class="visit-us">
        <h2>Visit Us</h2>
        <div class="visit-container">

            <!-- Left Side -->
            <div class="contact-info">
                <h3>Contact Information</h3>

                <div class="info-item">
                    <img src="img/location.svg" class="info-icon">
                    <div>
                        <h4>Address</h4>
                        <p>123 Music Street</p>
                        <p>Downtown, CA 90210</p>
                    </div>
                </div>

                <div class="info-item">
                    <img src="img/phone.svg" class="info-icon">
                    <div>
                        <h4>Phone</h4>
                        <p>(555) 123-4567</p>
                    </div>
                </div>

                <div class="info-item">
                    <img src="img/mail.svg" class="info-icon">
                    <div>
                        <h4>Email</h4>
                        <p>info@guithub.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <img src="img/clock-check.svg" class="info-icon">
                    <div>
                        <h4>Store Hours</h4>
                        <p>Monday - Saturday: 10am - 8pm</p>
                        <p>Sunday: 12pm - 6pm</p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form>
                    <label>Name</label>
                    <input type="text" placeholder="Your name">

                    <label>Email</label>
                    <input type="email" placeholder="your@email.com">

                    <label>Message</label>
                    <textarea placeholder="How can we help you?"></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-col">
                <div class="footer-logo">
                    <a href="#">Guit<span style="color: #FF6B00;">Hub.</span></a>
                </div>
                <p>Your trusted source for premium guitars and musical equipment since 2026.</p>
            </div>

            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="about.php">About Us</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Connect With Us</h3>
                <div class="socials">
                    <a href="#"><img src="img/fb.png" class="social-icon"></a>
                    <a href="#"><img src="img/ig.png" class="social-icon"></a>
                    <a href="#"><img src="img/tk.png" class="social-icon"></a>
                    <a href="#"><img src="img/x.png"  class="social-icon"></a>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            © 2026 GuitHub. All rights reserved. |
            Final Project - Web Development DIT 2-7
        </div>
    </footer>

    <!-- Chat Widget -->
    <?php include 'chatbot_widget.php'; ?>

    <!-- Unified JS (hamburger + product filter + admin) -->
    <script src="script.js" defer></script>

</body>
</html>
