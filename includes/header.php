<?php
session_start();
require('db.php');
include('remove_cart.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="">
	<meta name="description" content="Bookland-Book Store Ecommerce Website">
	<meta property="og:title" content="Bookland-Book Store Ecommerce Website">
	<meta property="og:description" content="Bookland-Book Store Ecommerce Website">
	<meta property="og:image" content="https://makaanlelo.com/tf_products_007/bookland/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" type="image/x-icon" href="images/favicon.png">

	<!-- PAGE TITLE HERE -->
	<title>Bookland Book Store Ecommerce Website</title>

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://js.stripe.com/v3/"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@5/css/themify-icons.css">



	<!-- GOOGLE FONTS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

</head>

<body>

	<div class="page-wraper">
		<!-- <div id="loading-area" class="preloader-wrapper-1">
			<div class="preloader-inner">
				<div class="preloader-shade"></div>
				<div class="preloader-wrap"></div>
				<div class="preloader-wrap wrap2"></div>
				<div class="preloader-wrap wrap3"></div>
				<div class="preloader-wrap wrap4"></div>
				<div class="preloader-wrap wrap5"></div>
			</div>
		</div> -->

		<!-- Header -->
		<header class="site-header mo-left header style-1">
			<!-- Main Header -->
			<div class="header-info-bar">
				<div class="container clearfix">
					<!-- Website Logo -->
					<div class="logo-header logo-dark">
						<a href="index.php"><img src="images/logo.png" alt="logo"></a>
					</div>

					<!-- EXTRA NAV -->
					<div class="extra-nav">
						<div class="extra-cell">
							<ul class="navbar-nav header-right">
								<?php
								if (isset($_POST['checkbox'])) {
									unset($_SESSION['wish']);
									if (isset($_SESSION['wish'])) {
										$cheack_id = array_column($_SESSION['wish'], 'id');
										if (in_array($_POST['product_id'], $cheack_id)) {
											echo '
											<script> 
											alert("Item already added"); 
											</script>
										';
										} else {
											$_SESSION['wish'][] = array(
												'id' => $_POST['product_id'],
												'item_name' => $_POST['item_name'],
												'image' => $_POST['image'],
												'price' => $_POST['price']
											);
										}
									} else {
										$_SESSION['wish'][] = array(
											'id' => $_POST['product_id'],
											'item_name' => $_POST['item_name'],
											'image' => $_POST['image'],
											'price' => $_POST['price']
										);
									}
								}
								?>
								<li class="nav-item">
									<a class="nav-link" href="wishlist.php">
										<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path>
										</svg>
										<span class="badge">
											<?php
											if (isset($_SESSION['wish'])) {
												echo count($_SESSION['wish']);
											} else {
												echo '0';
											}
											?>
										</span>
									</a>
								</li>
								<li class="nav-item">
									<button type="button" class="nav-link box cart-btn">
										<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
											<path d="M0 0h24v24H0V0z" fill="none"></path>
											<path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z">
											</path>
										</svg>
										<?php
										$count = 0;
										if (isset($_SESSION['cart'])) {
											$count = count($_SESSION['cart']);
										}
										?>
										<span class="badge"><?php echo $count; ?></span>
									</button>
									<ul class="dropdown-menu cart-list">
										<?php
										$total = 0;
										if (isset($_SESSION['cart'])) {
											$select = mysqli_query($conn, "SELECT * FROM books where status=1");
											$row = mysqli_fetch_assoc($select);
											$book_id = $row['book_id'];
											foreach ($_SESSION['cart'] as $key => $value) {
										?>
												<li class="">
													<div class="media">
														<div class="media-left">
															<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
															?>
																<a href="./books-catalog.php">
																	<img alt="" class="media-object" src="./images/<?php echo $value['image']; ?>">
																</a>
															<?php } else { // User not logged in, use JavaScript for SweetAlert 
															?>
																<a onclick="showAlert('shop')" href="#">
																	<img alt="" class="media-object" src="./images/<?php echo $value['image']; ?>">
																</a>
															<?php } ?>
														</div>
														<div class="media-body">
															<h6 class="dz-title"><a href="books-detail.php?book_id=<?php echo $book_id; ?>" class="media-heading"><?php echo $value['item_name']; ?></a></h6>
															<span class="dz-price">$<?php echo $value['price']; ?></span>
															<form method="post">
																<button type="submit" class="item-close" name="remove-item">×</button>
																<input type="hidden" name="item-name" value="<?php echo $value['item_name']; ?>">
																<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
															</form>
														</div>
													</div>
												</li>
										<?php
												$total += $value['price'];
											}
										}
										?>
										<li class=" cart-item text-center">
											<h6 class="text-secondary">Total = $<?php echo $total; ?></h6>
										</li>
										<li class="text-center d-flex">
											<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
											?>
												<a href="shop-cart.php" class="btn btn-sm btn-primary me-2 btnhover w-100">View Cart</a>
												<a href="shop-checkout.php" class="btn btn-sm btn-outline-primary btnhover w-100">Checkout</a>
											<?php } else { // User not logged in, use JavaScript for SweetAlert 
											?>
												<a onclick="showAlert('shop-cart.php')" href="#" class="btn btn-sm btn-primary me-2 btnhover w-100">View Cart</a>
												<a onclick="showAlert('shop-checkout.php')" href="#" class="btn btn-sm btn-outline-primary btnhover w-100">Checkout</a>
											<?php } ?>
										</li>
									</ul>
								</li>
								<?php if (isset($_SESSION['email'])) {
									$email = $_SESSION['email'];
									$select = mysqli_query($conn, "select * from users where email='$email'");
									while ($row = mysqli_fetch_assoc($select)) {
										$_SESSION['user_id'] = $row['user_id'];
										$username = $row['name'];
										$userImage = $row['image'];
										$userEmail = $row['email'];
									}
								?>
									<li class="nav-item dropdown profile-dropdown  ms-4">
										<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="./images/<?php echo $userImage; ?>" alt="/">
											<div class="profile-info">
												<h6 class="title"><?php echo $username; ?></h6>
												<span><?php echo $userEmail; ?></span>
											</div>
										</a>
										<div class="dropdown-menu py-0 dropdown-menu-end">
											<div class="dropdown-header">
												<h6 class="m-0"><?php echo $username; ?></h6>
												<span><?php echo $userEmail; ?></span>
											</div>
											<div class="dropdown-body">
												<a href="my-profile.html" class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
													<div>
														<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
															<path d="M0 0h24v24H0V0z" fill="none"></path>
															<path d="M12 6c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2m0 10c2.7 0 5.8 1.29 6 2H6c.23-.72 3.31-2 6-2m0-12C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
															</path>
														</svg>
														<span class="ms-2">Profile</span>
													</div>
												</a>
												<a href="user_order.php" class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
													<div>
														<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#000000">
															<path d="M0 0h24v24H0V0z" fill="none"></path>
															<path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z">
															</path>
															<span class="ms-2">My Order</span>
														</svg>
													</div>
												</a>
											</div>
											<div class="dropdown-footer">
												<a class="btn btn-primary w-100 btnhover btn-sm" href="includes/logOut.php">Log
													Out</a>
											</div>
										</div>
									</li>
								<?php
								} else {
								?>
									<li class="nav-item ms-4">
										<a href="./login.php" class="btn btn-primary btnhover">Login/Register</a>
									</li>
								<?php
								} ?>
							</ul>
						</div>
					</div>

					<!-- header search nav -->
					<div class="header-search-nav">
						<form class="header-item-search" method="post" action="search.php">
							<div class="input-group search-input">
								<select class="default-select" name="category">
									<option value="">Category</option>
									<?php
									// fetch all categories name;
									$select = mysqli_query($conn, "select * from categories where status=1");
									while ($row = mysqli_fetch_assoc($select)) {
									?>
										<option><?php echo $row['categories_name'] ?></option>
									<?php
									}
									?>
								</select>
								<input type="text" class="form-control" name="searchTerm" aria-label="Text input with dropdown button" placeholder="Search Books Here">
								<button class="btn" type="submit" name="search" type="button"><i class="flaticon-loupe"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Main Header End -->

			<!-- Main Header -->
			<div class="sticky-header main-bar-wraper navbar-expand-lg">
				<div class="main-bar clearfix">
					<div class="container clearfix">
						<!-- Website Logo -->
						<div class="logo-header logo-dark">
							<a href="index.html"><img src="images/logo.png" alt="logo"></a>
						</div>

						<!-- Nav Toggle Button -->
						<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>

						<!-- EXTRA NAV -->
						<div class="extra-nav">
							<div class="extra-cell">
								<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
								?>
									<a href="contact-us.php" class="btn btn-primary btnhover">Get In Touch</a>
								<?php } else { // User not logged in, use JavaScript for SweetAlert 
								?>
									<a onclick="showAlert('contact-page')" href="#" class="btn btn-primary btnhover">Get In Touch</a>
								<?php } ?>
							</div>
						</div>

						<!-- Main Nav -->
						<div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
							<div class="logo-header logo-dark">
								<a href="index.html"><img src="images/logo.png" alt=""></a>
							</div>
							<form class="search-input">
								<div class="input-group">
									<input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Search Books Here">
									<button class="btn" type="button"><i class="flaticon-loupe"></i></button>
								</div>
							</form>
							<ul class="nav navbar-nav">
								<li><a href="index.php"><span>Home</span></a></li>
								<li><a href="about-us.php"><span>About Us</span></a></li>
								<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
								?>
									<li><a href="books-catalog.php"><span>Books Catalog</span></a></li>
									<li><a href="pricing.php"><span>Payment/price</span></a></li>
									<li><a href="contact-us.php"><span>Contact Us</span></a></li>
								<?php } else { // User not logged in, use JavaScript for SweetAlert 
								?>
									<li><a onclick="showAlert('books-catalog')" href="#"><span>Books Catalog</span></a></li>
									<li><a onclick="showAlert('pricing')" href="#"><span>Payment/price</span></a></li>
									<li><a onclick="showAlert('contact-us')" href="#"><span>Contact Us</span></a></li>
								<?php } ?>
							</ul>
							<div class="dz-social-icon">
								<ul>
									<li><a class="fab fa-facebook-f" target="_blank" href="https://www.facebook.com/dexignzone"></a></li>
									<li><a class="fab fa-twitter" target="_blank" href="https://twitter.com/dexignzones"></a></li>
									<li><a class="fab fa-linkedin-in" target="_blank" href="https://www.linkedin.com/showcase/3686700/admin/"></a></li>
									<li><a class="fab fa-instagram" target="_blank" href="https://www.instagram.com/website_templates__/"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Header End -->

		</header>
		<!-- Header End -->

		<div class="page-content bg-white">