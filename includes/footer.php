</div>

<!-- Footer -->
<footer class="site-footer style-1">
    <!-- Footer Category -->
    <div class="footer-category">
        <div class="container">
            <div class="category-toggle">
                <a href="javascript:void(0);" class="toggle-btn">Books categories</a>
                <div class="toggle-items row">
                    <div class="footer-col-book">
                        <ul>
                            <?php
                            // fetch all categories name;
                            $select = mysqli_query($conn, "select * from categories where status=1");
                            while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                                ?>
                                    <li><a href="books-catalog.php"><?php echo $row['categories_name'] ?></a></li>
                                <?php } else { // User not logged in, use JavaScript for SweetAlert 
                                ?>
                                    <li><a onclick="showAlert('categories-page')" href="#"><?php echo $row['categories_name'] ?></a></li>
                                <?php } ?>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Category End -->

    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="widget widget_about">
                        <div class="footer-logo logo-white">
                            <a href="index.html"><img src="images/logo.png" alt=""></a>
                        </div>
                        <p class="text">Bookland is a Book Store Ecommerce Website Template by DexignZone lorem
                            ipsum dolor sit</p>
                        <div class="dz-social-icon style-1">
                            <ul>
                                <li><a href="https://www.facebook.com/dexignzone" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCGL8V6uxNNMRrk3oZfVct1g" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="https://www.linkedin.com/showcase/3686700/admin/" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/website_templates__/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Our Links</h5>
                        <ul>
                            <li><a href="about-us.php">About us</a></li>
                            <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                            ?>
                                <li><a href="contact-us.php">Contact us</a></li>
                                <li><a href="pricing.php">Pricing Table</a></li>
                            <?php } else { // User not logged in, use JavaScript for SweetAlert 
                            ?>
                                <li><a onclick="showAlert('contact us.php')" href="#">Contact us</a></li>
                                <li><a onclick="showAlert('pricing.php')" href="#">Pricing Table</a></li>
                            <?php } ?>
                            <li><a href="faq.php">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Bookland ?</h5>
                        <ul>
                            <li><a href="index.php">Bookland</a></li>
                            <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                            ?>
                                <li><a href="books-catalog.php">Shop</a></li>
                            <?php } else { // User not logged in, use JavaScript for SweetAlert 
                            ?>
                                <li><a onclick="showAlert('shop.php')" href="#">Shop</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="widget widget_services">
                        <h5 class="footer-title">Resources</h5>
                        <ul>
                            <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                            ?>
                                <li><a href="Privacy-Policy.php">Privacy Policy</a></li>
                                <li><a href="shop-cart.php">Shop Cart</a></li>
                            <?php } else { // User not logged in, use JavaScript for SweetAlert 
                            ?>
                                <li><a onclick="showAlert('privacy-page')" href="#">Privacy Policy</a></li>
                                <li><a onclick="showAlert('shop cart')" href="#">Shop Cart</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                            ?>
                                <li><a href="includes\logOut.php">Logout</a></li>
                            <?php } else {
                            ?>
                                <li><a href="login.php">Login</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="widget widget_getintuch">
                        <h5 class="footer-title">Get in Touch With Us</h5>
                        <ul>
                            <li>
                                <i class="flaticon-placeholder"></i>
                                <span>832 Thompson Drive, San Fransisco CA 94107,US</span>
                            </li>
                            <li>
                                <i class="flaticon-phone"></i>
                                <span>+123 345123 556<br>
                                    +123 345123 556</span>
                            </li>
                            <li>
                                <i class="flaticon-email"></i>
                                <span>support@bookland.id<br>
                                    info@bookland.id</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row fb-inner">
                <div class="col-lg-6 col-md-12 text-start">
                    <p class="copyright-text">Bookland Book Store Ecommerce Website - © 2024 All Rights Reserved
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer End -->

<button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="js/jquery.min.js"></script><!-- JQUERY MIN JS -->
<script src="js/wow.min.js"></script><!-- WOW JS -->
<script src="js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP MIN JS -->
<script src="js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELECT MIN JS -->
<script src="js/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="js/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="js/dz.carousel.js"></script><!-- DZ CAROUSEL JS -->
<script src="js/dz.ajax.js"></script><!-- AJAX -->
<script src="js/custom.js"></script><!-- CUSTOM JS -->
<!-- sweet alert link JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    function showAlert(target) {
        Swal.fire({
            title: "Login Required!",
            text: "You need to login first to access " + target,
            icon: "warning",
            showCancelButton: true, // Add a "Cancel" button
            confirmButtonColor: '#3085d6', // Customize button colors (optional)
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) { // Check if user clicks "OK"
                window.location.href = "login.php"; // Redirect to login page
            }
        });
    }
</script>
</body>

</html>