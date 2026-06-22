<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitHub - Products</title>
    <link rel="stylesheet" href="products.css">
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
            <li><a href="" class="active">Products</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <a href="admin.php" class="admin-btn">
            <img src="img/settings.svg" alt="Settings icon" class="admin-icon">
            Admin
        </a>
        <!-- Hamburger injected by script.js -->
    </nav>

    <section class="products-page">
        <div class="container">

            <div class="page-header">
                <h1>Our Guitar Collection</h1>
                <p>Browse our premium selection of guitars from top brands</p>
            </div>

            <!-- Filter Box -->
            <div class="filter-box">
                <h2>Filters</h2>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="searchFilter">Search</label>
                        <input type="text" id="searchFilter" placeholder="Search guitars...">
                    </div>
                    <div class="filter-group">
                        <label for="categoryFilter">Category</label>
                        <select id="categoryFilter">
                            <option value="all">All</option>
                            <option value="Electric">Electric</option>
                            <option value="Acoustic">Acoustic</option>
                            <option value="Bass">Bass</option>
                            <option value="Guitar Effects">Guitar Effects</option>
                            <option value="Exotic">Exotic</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="priceFilter">Price Range</label>
                        <select id="priceFilter">
                            <option value="all">All</option>
                            <option value="0-1000">₱0 – ₱1,000</option>
                            <option value="1000-5000">₱1,000 – ₱5,000</option>
                            <option value="5000-50000">₱5,000 – ₱50,000</option>
                            <option value="50000-999999999">₱50,000+</option>
                        </select>
                    </div>
                </div>
            </div>

            <p class="product-count" id="productCount">Showing 15 of 15 products</p>

            <!-- Products Grid -->
            <div class="guitar-grid" id="guitarGrid">

                <div class="product-card" data-category="Electric" data-price="45150">
                    <img src="img/stratocaster.jpg" alt="Stratocaster">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Fender Stratocaster</h3>
                        <div class="card-footer">
                            <h4>₱45,150.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Acoustic" data-price="215000">
                    <img src="img/martin.jpg" alt="Martin D-28">
                    <div class="card-content">
                        <span class="product-category">Acoustic</span>
                        <h3>Martin D-28</h3>
                        <div class="card-footer">
                            <h4>₱215,000.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Bass" data-price="160000">
                    <img src="img/stingray.jpg" alt="Stingray Bass">
                    <div class="card-content">
                        <span class="product-category">Bass</span>
                        <h3>Ernie Ball Music Man StingRay 5</h3>
                        <div class="card-footer">
                            <h4>₱160,000.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Electric" data-price="130000">
                    <img src="img/lespaul.jpg" alt="Les Paul">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Gibson Les Paul</h3>
                        <div class="card-footer">
                            <h4>₱130,000.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Electric" data-price="30150">
                    <img src="img/es335.jpg" alt="ES-335">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Epiphone ES-335</h3>
                        <div class="card-footer">
                            <h4>₱30,150.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Electric" data-price="70249">
                    <img src="img/sg.jpg" alt="SG">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Gibson Doubleneck SG</h3>
                        <div class="card-footer">
                            <h4>₱70,249.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Electric" data-price="43100">
                    <img src="img/tele.jpg" alt="Telecaster">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Fender Telecaster</h3>
                        <div class="card-footer">
                            <h4>₱43,100.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Acoustic" data-price="119999">
                    <img src="img/taylor.jpg" alt="Taylor">
                    <div class="card-content">
                        <span class="product-category">Acoustic</span>
                        <h3>Taylor 314ce</h3>
                        <div class="card-footer">
                            <h4>₱119,999.50</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Bass" data-price="210150">
                    <img src="img/rickenbacker.jpg" alt="Rickenbacker">
                    <div class="card-content">
                        <span class="product-category">Bass</span>
                        <h3>Rickenbacker Bass Guitar</h3>
                        <div class="card-footer">
                            <h4>₱210,150.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Bass" data-price="10199">
                    <img src="img/pbass.jpg" alt="PBass">
                    <div class="card-content">
                        <span class="product-category">Bass</span>
                        <h3>Fernandes Precision Bass</h3>
                        <div class="card-footer">
                            <h4>₱10,199.98</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Electric" data-price="29250">
                    <img src="img/jaguar.jpg" alt="Jaguar">
                    <div class="card-content">
                        <span class="product-category">Electric</span>
                        <h3>Squier CV '70s Jaguar</h3>
                        <div class="card-footer">
                            <h4>₱29,250.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Exotic" data-price="67">
                    <img src="img/pizza.jpg" alt="Pizza Guitar">
                    <div class="card-content">
                        <span class="product-category">Exotic</span>
                        <h3>Crust Punk Pizza 3000 Guitar</h3>
                        <div class="card-footer">
                            <h4>₱67.69</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Guitar Effects" data-price="3000">
                    <img src="img/chorus.jpg" alt="Boss Chorus">
                    <div class="card-content">
                        <span class="product-category">Guitar Effects</span>
                        <h3>Boss Chorus CE-2w</h3>
                        <div class="card-footer">
                            <h4>₱3,000.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Guitar Effects" data-price="67">
                    <img src="img/drive.jpg" alt="Google OverDrive">
                    <div class="card-content">
                        <span class="product-category">Guitar Effects</span>
                        <h3>Google OverDrive</h3>
                        <div class="card-footer">
                            <h4>₱67.67</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

                <div class="product-card" data-category="Guitar Effects" data-price="1500">
                    <img src="img/joyo.jpg" alt="Joyo American">
                    <div class="card-content">
                        <span class="product-category">Guitar Effects</span>
                        <h3>Joyo American</h3>
                        <div class="card-footer">
                            <h4>₱1,500.00</h4>
                            <a href="#" class="view-btn">Buy</a>
                        </div>
                    </div>
                </div>

            </div><!-- /guitar-grid -->

            <!-- No Results State -->
            <div id="noResults" style="display:none" class="no-results">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#4f5b73" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    <line x1="8" y1="11" x2="14" y2="11"/>
                </svg>
                <h3>No guitars found</h3>
                <p>Try adjusting your search or filter criteria.</p>
            </div>

        </div><!-- /container -->
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <div class="footer-logo">
                    <a href="index.php">Guit<span style="color:#FF6B00;">Hub.</span></a>
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
                    <a href="#"><img src="img/fb.png" class="social-icon" alt="Facebook"></a>
                    <a href="#"><img src="img/ig.png" class="social-icon" alt="Instagram"></a>
                    <a href="#"><img src="img/tk.png" class="social-icon" alt="TikTok"></a>
                    <a href="#"><img src="img/x.png"  class="social-icon" alt="X"></a>
                    <a href="#" aria-label="Facebook">FB</a>
                    <a href="#" aria-label="Instagram">IG</a>
                    <a href="#" aria-label="TikTok">TK</a>
                    <a href="#" aria-label="X">X</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 GuitHub. All rights reserved. | Final Project - Web Development DIT 2-7
        </div>
    </footer>

    <!-- Chat Widget -->
    <?php include 'chatbot_widget.php'; ?>

    <!-- Unified JS (hamburger + product filter + admin) -->
    <script src="script.js" defer></script>

</body>
</html>
