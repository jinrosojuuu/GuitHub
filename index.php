<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitHub - Home</title>
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
            <li><a href="" class="active">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <a href="admin.php" class="admin-btn">
            <img src="img/settings.svg" alt="Settings icon" class="admin-icon">
            Admin
        </a>
        <!-- Hamburger injected by script.js -->
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>
                Find Your Perfect<br>
                Sound at Guit<span style="color:#FF6B00;">Hub.</span>
            </h1>
            <p>
                Premium guitars, wide range of prices, and excellent customer service.<br>
                Your musical journey starts here.
            </p>
            <a href="products.php" class="shop-btn">Shop Now</a>
            <a href="about.php" class="learn-btn">Learn More</a>
        </div>
        <div class="hero-image">
            <img src="img/lespaul.jpg" alt="Guitar">
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="feature-card">
            <div class="icon-circle">
                <img src="img/premium.png" alt="Guitar Icon" class="icon">
            </div>
            <h3>Premium Guitars</h3>
            <p>Handpicked selection from top brands worldwide</p>
        </div>
        <div class="feature-card">
            <div class="icon-circle">
                <img src="img/shipping.png" alt="Shipping Icon" class="icon">
            </div>
            <h3>Free Shipping</h3>
            <p>On orders over ₱500 with secure packaging</p>
        </div>
        <div class="feature-card">
            <div class="icon-circle">
                <img src="img/warranty.png" alt="Warranty Icon" class="icon">
            </div>
            <h3>1-Year Warranty</h3>
            <p>All guitars backed by manufacturer warranty</p>
        </div>
        <div class="feature-card">
            <div class="icon-circle">
                <img src="img/support.png" alt="Support Icon" class="icon">
            </div>
            <h3>Expert Support</h3>
            <p>Our team is here to help you find your sound</p>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="products">
        <h1>Featured Guitars</h1>
        <div class="guitar-grid">

            <div class="product-card">
                <img src="img/stratocasters.jpg" alt="Stratocaster">
                <div class="card-content">
                    <span class="product-category">Electric</span>
                    <h3>Fender Stratocaster</h3>
                    <p>Classic tone, versatile playability, and iconic design.</p>
                    <div class="card-footer">
                        <a href="products.php" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="img/martin.jpg" alt="Martin D-28">
                <div class="card-content">
                    <span class="product-category">Acoustic</span>
                    <h3>Martin D-28</h3>
                    <p>Timeless design and exceptional sound quality.</p>
                    <div class="card-footer">
                        <a href="products.php" class="view-btn">View</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <img src="img/musicamp.jpg" alt="Stingray Bass">
                <div class="card-content">
                    <span class="product-category">Bass</span>
                    <h3>EB Music Man Bass Guitar</h3>
                    <p>Iconic design and versatile sound for any genre.</p>
                    <div class="card-footer">
                        <a href="products.php" class="view-btn">View</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="view-all-container">
            <a href="products.php" class="view-all-btn">View All Products</a>
        </div>
    </section>

    <!-- Tagline Section -->
    <section class="tagline">
        <h1>Ready to Rock?</h1>
        <p>Try our GuitHub Chatbot to find the perfect guitar for your style and budget.</p>
        <br>
        <p>Click the chat button in the bottom right corner to get started!</p>
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
                    <li><a href="#">Home</a></li>
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
