<?php
    require_once '../config/db_connect.php';

    // Best Sellers (category_id: 7)
    $sql = 'SELECT prod_id FROM product_categories WHERE category_id = 7';
    $best_sellers = $conn->query($sql);

    // New arrivals
    $sql = 'SELECT prod_id FROM products
    ORDER BY prod_created_at DESC
    LIMIT 10
    ';
    $new_arrivals = $conn->query($sql);

    // All Products
    $sql = 'SELECT prod_id FROM products';
    $all_products = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Supplies</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/utilities.css">
</head>
<body>
    <a href="../admin/admin.php" id="navigate-to-admin">Admin Panel</a>
    <div class="h-top">
        <a href="#navigate-to-admin">
            <h1>Party Supplies</h1>
        </a>
        <div class="top-middle">
            <div class="searchbar">
                <img src="../assets/images/icons/search.svg" alt="">
                <input type="text" name="search" id="search" placeholder="Search">
            </div>
            <a href="#">
                <img class="invert" id="cart" src="../assets/images/icons/cart.svg" alt="Cart">
            </a>
        </div>
        <nav id="main-nav">
            <ul>
                <li><a href="#start-point">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#contact-us">Contact</a></li>
                <li>
                    <a href="#" class="profile_a">
                        <img id="profile" class="invert" src="../assets/images/icons/profile.svg" alt="Account">
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <header>
        <div id="start-point" class="h-bottom">
            <nav id="nav-item-list">
                <ul>
                    <li class="dropdown">
                        <a href="#">Baby Shower</a>
                        <div class="dropdown-content">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Birthday</a>
                        <div class="dropdown-content">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                        </div>
                    </li>
                    <li><a href="#">Welcome</a></li>
                    <li><a href="#">Love</a></li>
                    <li><a href="#">Festive</a></li>
                    <li><a href="#">Other</a></li>
                    <li><a href="#">By Categories</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <!-- Best Sellers -->
        <section class="best-sellers">
            <h2>Best Sellers</h2>
            <div class="slider">
                <img id="left" class="invert pointer" src="../assets/images/icons/arrow_left.svg" alt="">
                <div class="card-container">
                    <?php
                        while ($row = $best_sellers->fetch_assoc()) {
                            $prod_id = $row['prod_id'];
                            $prod_sql = "SELECT * FROM products WHERE prod_id = $prod_id";
                            $prod_result = $conn->query($prod_sql);
                            $prod = $prod_result->fetch_assoc();

                            if ($prod) {
                                echo '
                                <div class="card" data-id="'.$prod_id.'">
                                    <div class="card-info">
                                        <div class="card-image">
                                            <img src="../assets/images/products/'.$prod['prod_img'].'" alt="'.$prod['prod_name'].'">
                                        </div>
                                        <div class="prod-info">
                                            <p class="prod-name">'.$prod['prod_name'].'</p>
                                            <p class="price">₹'.$prod['prod_price'].'</p>
                                            <p class="rating">'
                                            .$prod['avg_rating'].' Stars
                                            | '.$prod['num_ratings'].'
                                            </p>
                                        </div>
                                    </div>
                                    <p class="add-to-cart">
                                        Add to Cart
                                        <img class="invert cart" src="../assets/images/icons/cart.svg" alt="Cart">
                                    </p>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
                <img id="right" class="invert pointer" src="../assets/images/icons/arrow_right.svg" alt="">
            </div>
        </section>

        <!-- New Arrivals -->
        <section class="new-arrivals">
            <h2>New Arrivals</h2>
            <div class="slider">
                <img id="left" class="invert pointer" src="../assets/images/icons/arrow_left.svg" alt="">
                <div class="card-container">
                    <?php
                        while ($row = $new_arrivals->fetch_assoc()) {
                            $prod_id = $row['prod_id'];
                            $prod_sql = "SELECT * FROM products WHERE prod_id = $prod_id";
                            $prod_result = $conn->query($prod_sql);
                            $prod = $prod_result->fetch_assoc();

                            if ($prod) {
                                echo '
                                <div class="card" data-id="'.$prod_id.'">
                                    <div class="card-info">
                                        <div class="card-image">
                                            <img src="../assets/images/products/'.$prod['prod_img'].'" alt="'.$prod['prod_name'].'">
                                        </div>
                                        <div class="prod-info">
                                            <p class="prod-name">'.$prod['prod_name'].'</p>
                                            <p class="price">₹'.$prod['prod_price'].'</p>
                                            <p class="rating">'.$prod['avg_rating'].' Stars</p>
                                        </div>
                                    </div>
                                    <p class="add-to-cart">
                                        Add to Cart
                                        <img class="invert cart" src="../assets/images/icons/cart.svg" alt="Cart">
                                    </p>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
                <img id="right" class="invert pointer" src="../assets/images/icons/arrow_right.svg" alt="">
            </div>
        </section>

        <!-- All Products -->
        <section class="all-products">
            <h2>All Products</h2>
            <div class="slider">
                <img id="left" class="invert pointer" src="../assets/images/icons/arrow_left.svg" alt="">
                <div class="card-container">
                    <?php
                        while ($row = $all_products->fetch_assoc()) {
                            $prod_id = $row['prod_id'];
                            $prod_sql = "SELECT * FROM products WHERE prod_id = $prod_id";
                            $prod_result = $conn->query($prod_sql);
                            $prod = $prod_result->fetch_assoc();

                            if ($prod) {
                                echo '
                                <div class="card" data-id="'.$prod_id.'">
                                    <div class="card-info">
                                        <div class="card-image">
                                            <img src="../assets/images/products/'.$prod['prod_img'].'" alt="'.$prod['prod_name'].'">
                                        </div>
                                        <div class="prod-info">
                                            <p class="prod-name">'.$prod['prod_name'].'</p>
                                            <p class="price">₹'.$prod['prod_price'].'</p>
                                            <p class="rating">'.$prod['avg_rating'].' Stars</p>
                                        </div>
                                    </div>
                                    <p class="add-to-cart">
                                        Add to Cart
                                        <img class="invert cart" src="../assets/images/icons/cart.svg" alt="Cart">
                                    </p>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
                <img id="right" class="invert pointer" src="../assets/images/icons/arrow_right.svg" alt="">
            </div>
        </section>

        <!-- About Us -->
        <section id="about-us">
            <h2>About Us</h2>
            <div class="about-content">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, minus! Possimus suscipit blanditiis qui sunt ut debitis harum! Itaque natus recusandae explicabo est minus illo corporis vitae, sit perspiciatis eligendi in consequatur velit laboriosam facere sequi maiores labore, nulla omnis consectetur dolor!
                </p>
                <img class="pointer" src="../assets/images/icons/profile2.svg" alt="About Us">
            </div>
        </section>

        <!-- Contact Us -->
          <section id="contact-us">
            <h2>Contact Us</h2>
            <div class="contact-content">
                <div id="contact-text">
                    <p id="address">
                        Lorem, ipsum dolor <br>
                        Lorem ipsum dolor sit amet <br>
                        Lorem ipsum, dolor sit amet consectetur <br>
                        Downtown, Dubai
                        United Arab Emirates
                    </p>
                    <ul id="social-info">
                        <div id="social-number">
                            <li class="phone">
                                <a href="tel:9876543210">
                                    <img class="invert" src="../assets/images/icons/phone.svg" alt="Phone Number">
                                </a>
                                <p>9876543210</p>
                            </li>
                            <li class="whatsapp">
                                <a href="https://wa.me/9876543210" target="_blank">
                                    <img src="../assets/images/icons/whatsapp.webp" alt="WhatsApp Number">
                                </a>
                                <p>9876543210</p>
                            </li>
                        </div>
                        <div id="social-media">
                            <li class="linkedin">
                                <a href="https://www.linkedin.com/in/your-profile" target="_blank">
                                    <img src="../assets/images/icons/linkedin.png" alt="LinkedIn">
                                </a>
                            </li>
                            <li class="instagram">
                                <a href="https://www.instagram.com/your-profile" target="_blank">
                                    <img src="../assets/images/icons/instagram.png" alt="Instagram">
                                </a>
                            </li>
                            <li class="facebook">
                                <a href="https://www.facebook.com/your-profile" target="_blank">
                                    <img src="../assets/images/icons/facebook.webp" alt="Facebook">
                                </a>
                            </li>
                        </div>
                    </ul>
                    
                </div>
                <iframe id="maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.178510207627!2d55.27180147483742!3d25.197201831701513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43348a67e24b%3A0xff45e502e1ceb7e2!2sBurj%20Khalifa!5e0!3m2!1sen!2sin!4v1740343607937!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </section>

    </main>
    
    <footer>
        <p>&copy; 2025 Party Supplies. All rights reserved.</p>
    </footer>


    <!-- JavaScript -->
    <script src="./script/script.js"></script>
    <!-- LordIcons -->
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</body>
</html>
