<?php
require('includes/header.php');
require('includes/add-to-cart.php');
?>


<!--Swiper Banner Start -->
<div class="main-slider style-1">
	<div class="main-swiper">
		<div class="swiper-wrapper">
			<?php
			$select = mysqli_query($conn, "SELECT * FROM books WHERE author='john smith' AND price < 13 AND status = 1 LIMIT 2");
			while ($row = mysqli_fetch_assoc($select)) {
			?>
				<div class="swiper-slide bg-blue" style="background-image: url(./images/waveelement.png);">
					<div class="container">
						<div class="banner-content">
							<div class="row">
								<div class="col-md-6">
									<div class="swiper-content">
										<div class="content-info">
											<h6 class="sub-title" data-swiper-parallax="-10">BEST MANAGEMENT
											</h6>
											<h1 class="title mb-0" data-swiper-parallax="-20"><?php echo $row['title'] ?></h1>
											<ul class="dz-tags" data-swiper-parallax="-30">
												<li><a href="javascript:void(0);"><?php echo $row['author'] ?></a></li>
												<li><a href="javascript:void(0);"><?php echo $row['books_categories'] ?></a>
												</li>
											</ul>
											<p class="text mb-0" data-swiper-parallax="-40">
												<?php echo $row['description'] ?>
											</p>
											<div class="price" data-swiper-parallax="-50">
												<span class="price-num">$<?php echo $row['price'] ?></span>
												<del>$17.25</del>
												<span class="badge badge-danger">15% OFF</span>
											</div>
											<div class="content-btn" data-swiper-parallax="-60">
												<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
												?>
													<a class="btn btn-primary btnhover" href="books-catalog.php">Buy Now</a>
													<a class="btn border btnhover ms-4 text-white" href="books-detail.php?book_id=<?php echo $row['book_id']; ?>">See Details</a>
												<?php } else { // User not logged in, use JavaScript for SweetAlert 
												?>
													<!-- <li><a onclick="showAlert('shop cart')" href="#">Shop Cart</a></li> -->
													<a onclick="showAlert('catalog-pag')" class="btn btn-primary btnhover" href="#">Buy Now</a>
													<a onclick="showAlert('book-details')" class="btn border btnhover ms-4 text-white" href="#">See Details</a>
												<?php } ?>
											</div>
										</div>
										<div class="partner">
											<p>Our partner</p>
											<div class="brand-logo">
												<img src="images/partner-1.png" alt="client">
												<img class="mid-logo" src="images/partner-2.png" alt="client">
												<img src="images/partner-3.png" alt="client">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="banner-media" data-swiper-parallax="-100">
										<img src="images/banner-media.png" alt="banner-media">
									</div>
									<img class="pattern" src="images/Group.png" data-swiper-parallax="-100" alt="dots">
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
			<?php
			$select = mysqli_query($conn, "SELECT * FROM books WHERE author='Emily Johnson' AND price < 13 AND status = 1 LIMIT 2");
			while ($row = mysqli_fetch_assoc($select)) {
			?>
				<div class="swiper-slide bg-blue" style="background-image: url(images/waveelement.png);">
					<div class="container">
						<div class="banner-content">
							<div class="row">
								<div class="col-md-6">
									<div class="swiper-content">
										<div class="content-info">
											<h6 class="sub-title" data-swiper-parallax="-10">BEST SELLER</h6>
											<h1 class="title mb-0" data-swiper-parallax="-20"><?php echo $row['title'] ?>
											</h1>
											<ul class="dz-tags" data-swiper-parallax="-30">
												<li><a href="javascript:void(0);"><?php echo $row['author'] ?></a></li>
												<li><a href="javascript:void(0);"><?php echo $row['books_categories'] ?></a>
												</li>
											</ul>
											<p class="text mb-0" data-swiper-parallax="-40"><?php echo $row['description'] ?></p>
											<div class="price" data-swiper-parallax="-50">
												<span class="price-num">$<?php echo $row['price'] ?></span>
												<del>$16.0</del>
												<span class="badge badge-danger">20% OFF</span>
											</div>
											<div class="content-btn" data-swiper-parallax="-50">
												<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
												?>
													<a class="btn btn-primary btnhover" href="books-catalog.php">Buy Now</a>
													<a class="btn border btnhover ms-4 text-white" href="books-detail.php?book_id=<?php echo $row['book_id']; ?>">See Details</a>
												<?php } else { // User not logged in, use JavaScript for SweetAlert 
												?>
													<!-- <li><a onclick="showAlert('shop cart')" href="#">Shop Cart</a></li> -->
													<a onclick="showAlert('catalog-pag')" class="btn btn-primary btnhover" href="#">Buy Now</a>
													<a onclick="showAlert('book-details')" class="btn border btnhover ms-4 text-white" href="#">See Details</a>
												<?php } ?>
											</div>
										</div>
										<div class="partner">
											<p>Our partner</p>
											<div class="brand-logo">
												<img src="images/partner-1.png" alt="client">
												<img class="mid-logo" src="images/partner-2.png" alt="client">
												<img src="images/partner-3.png" alt="client">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="banner-media" data-swiper-parallax="-100">
										<img src="images/banner-media2.png" alt="banner-media1">
									</div>
									<img class="pattern" src="images/Group.png" data-swiper-parallax="-100" alt="dots">
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
		<div class="container swiper-pagination-wrapper">
			<div class="swiper-pagination-five"></div>
		</div>
	</div>
	<div class="swiper main-swiper-thumb">
		<div class="swiper-wrapper">
			<?php
			$select = mysqli_query($conn, "SELECT * FROM books WHERE price < 13 AND status = 1 LIMIT 8");
			while ($row = mysqli_fetch_assoc($select)) {
			?>
				<div class="swiper-slide">
					<div class="books-card">
						<div class="dz-media">
							<img src="./images/<?php echo $row['image'] ?>" alt="book">
						</div>
						<div class="dz-content">
							<h5 class="title mb-0"><?php echo $row['title'] ?></h5>
							<div class="dz-meta">
								<ul>
									<li><?php echo $row['author'] ?></li>
								</ul>
							</div>
							<div class="book-footer">
								<div class="price">
									<span class="price-num">$<?php echo $row['price'] ?></span>
								</div>
								<div class="rate">
									<i class="flaticon-star text-yellow"></i>
									<i class="flaticon-star text-yellow"></i>
									<i class="flaticon-star text-yellow"></i>
									<i class="flaticon-star text-yellow"></i>
									<i class="flaticon-star text-yellow"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
<!--Swiper Banner End-->

<!-- Client Start-->
<div class="bg-white py-5">
	<div class="container">
		<!--Client Swiper -->
		<div class="swiper client-swiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide"><img src="images/client1.svg" alt="client"></div>
				<div class="swiper-slide"><img src="images/client2.svg" alt="client"></div>
				<div class="swiper-slide"><img src="images/client3.svg" alt="client"></div>
				<div class="swiper-slide"><img src="images/client4.svg" alt="client"></div>
				<div class="swiper-slide"><img src="images/client5.svg" alt="client"></div>
			</div>
		</div>
	</div>
</div>
<!-- Client End-->

<!--Recommend Section Start-->
<section class="content-inner-1 bg-grey reccomend">
	<div class="container">
		<div class="section-head text-center">
			<h2 class="title">Recomended For You</h2>
			<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae ab laudantium iusto nemo temporibus vitae provident! Exercitationem voluptas necessitatibus neque quidem itaque culpa sapiente quasi quia saepe, distinctio fuga magni</p>
		</div>
		<!-- Swiper -->
		<div class="swiper-container swiper-two">
			<div class="swiper-wrapper">
				<?php
				// fetch all recomended books;
				$select = mysqli_query($conn, "SELECT * FROM books WHERE price > 10 AND status = 1");
				while ($row = mysqli_fetch_assoc($select)) {
				?>
					<div class="swiper-slide">
						<div class="books-card style-1 wow fadeInUp" data-wow-delay="0.2s">
							<div class="dz-media">
								<img src="./images/<?php echo $row['image'] ?>" alt="book">
							</div>
							<div class="dz-content">
								<h4 class="title"><?php echo $row['title'] ?></h4>
								<span class="price"><?php echo $row['price'] ?></span>
								<form method="POST">
									<input type="hidden" name="product_id" value="<?php echo $row['book_id']; ?>">
									<input type="hidden" name="item_name" value="<?php echo $row['title']; ?>">
									<input type="hidden" name="image" value="<?php echo $row['image']; ?>">
									<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
									<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
									<button type="submit" name="add-to-cart" class="btn btn-secondary box-btn btnhover btnhover2">
										<i class="flaticon-shopping-cart-1 m-r10"></i> Add to Cart
									</button>
								</form>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>

<!-- icon-box1 -->
<section class="content-inner-2">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="icon-bx-wraper style-1 m-b20 text-center">
					<div class="icon-bx-sm m-b10">
						<i class="flaticon-power icon-cell"></i>
					</div>
					<div class="icon-content">
						<h5 class="dz-title m-b10">Quick Delivery</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="icon-bx-wraper style-1 m-b20 text-center">
					<div class="icon-bx-sm m-b10">
						<i class="flaticon-shield icon-cell"></i>
					</div>
					<div class="icon-content">
						<h5 class="dz-title m-b10">Secure Payment</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
				<div class="icon-bx-wraper style-1 m-b20 text-center">
					<div class="icon-bx-sm m-b10">
						<i class="flaticon-like icon-cell"></i>
					</div>
					<div class="icon-content">
						<h5 class="dz-title m-b10">Best Quality</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.4s">
				<div class="icon-bx-wraper style-1 m-b20 text-center">
					<div class="icon-bx-sm m-b10">
						<i class="flaticon-star icon-cell"></i>
					</div>
					<div class="icon-content">
						<h5 class="dz-title m-b10">Return Guarantee</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- icon-box1 End-->

<!-- Book Sale -->
<section class="content-inner-1">
	<div class="container">
		<div class="section-head book-align">
			<h2 class="title mb-0">Books on Sale</h2>
			<div class="pagination-align style-1">
				<div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
				<div class="swiper-pagination-two"></div>
				<div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
			</div>
		</div>
		<div class="swiper-container books-wrapper-3 swiper-four">
			<div class="swiper-wrapper">
				<?php
				// fetch all books;
				$select = mysqli_query($conn, "select * from books where status=1 LIMIT 7");
				while ($row = mysqli_fetch_assoc($select)) {
				?>
					<div class="swiper-slide">
						<div class="books-card style-3 wow fadeInUp" data-wow-delay="0.1s">
							<div class="dz-media">
								<img src="./images/<?php echo $row['image'] ?>" alt="book">
							</div>
							<div class="dz-content">
								<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
								?>
									<h5 class="title"><a href="books-detail.php?book_id=<?php echo $row['book_id']; ?>"><?php echo $row['title'] ?></a></h5>
									<ul class="dz-tags">
										<li><a href="books-catalog.php">SPORTS,</a></li>
										<li><a href="books-catalog.php">DRAMA</a></li>
									</ul>
								<?php } else { // User not logged in, use JavaScript for SweetAlert 
								?>
									<h5 class="title"><a onclick="showAlert('books-detail.php')" href="#"><?php echo $row['title'] ?></a></h5>
									<ul class="dz-tags">
										<li><a onclick="showAlert('books-catalog.php')" href="#">SPORTS,</a></li>
										<li><a onclick="showAlert('books-catalog.php')" href="#">DRAMA</a></li>
									</ul>
								<?php } ?>
								<div class="book-footer">
									<div class="rate">
										<i class="flaticon-star"></i> 6.8
									</div>
									<div class="price">
										<span class="price-num">$9.5</span>
										<del>$<?php echo $row['price'] ?></del>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
<!-- Book Sale End -->

<!-- Feature Product -->
<section class="content-inner-1 bg-grey reccomend">
	<div class="container">
		<div class="section-head text-center">
			<div class="circle style-1"></div>
			<h2 class="title">Featured Product</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
				labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
				laboris </p>
		</div>
	</div>
	<div class="container">
		<div class="swiper-container books-wrapper-2 swiper-three">
			<div class="swiper-wrapper">
				<?php
				// fetch all books;
				$select = mysqli_query($conn, "SELECT * FROM books WHERE price < 13 AND status = 1 LIMIT 8");
				while ($row = mysqli_fetch_assoc($select)) {
				?>
					<div class="swiper-slide">
						<div class="books-card style-2">
							<div class="dz-media">
								<img src="./images/<?php echo $row['image'] ?>" alt="book">
							</div>
							<div class="dz-content">
								<h6 class="sub-title">BEST SELLER</h6>
								<h2 class="title"><?php echo $row['title'] ?></h2>
								<ul class="dz-tags">
									<li><?php echo $row['author'] ?></li>
									<li><?php echo $row['books_categories'] ?></li>
								</ul>
								<p class="text"><?php echo $row['description'] ?> </p>
								<div class="price">
									<span class="price-num">$9.5</span>
									<del>$<?php echo $row['price'] ?></del>
									<span class="badge">20% OFF</span>
								</div>
								<div class="bookcard-footer">
									<form method="POST">
										<input type="hidden" name="product_id" value="<?php echo $row['book_id']; ?>">
										<input type="hidden" name="item_name" value="<?php echo $row['title']; ?>">
										<input type="hidden" name="image" value="<?php echo $row['image']; ?>">
										<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
										<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
										<button type="submit" name="add-to-cart" class="btn btn-secondary box-btn btnhover btnhover2">
											<i class="flaticon-shopping-cart-1 m-r10"></i> Add to Cart
										</button>
									</form>
									<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
									?>
										<a href="books-detail.php?book_id=<?php echo $row['book_id']; ?>" class="btn btn-outline-secondary btnhover m-t15">See Details</a>
									<?php } else { // User not logged in, use JavaScript for SweetAlert 
									?>
										<a onclick="showAlert('books-detail.php')" href="#" class="btn btn-outline-secondary btnhover m-t15">See Details</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="pagination-align style-2">
				<div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
				<div class="swiper-pagination-three"></div>
				<div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
			</div>
		</div>
	</div>
</section>
<!-- Feature Product End -->

<!-- Special Offer-->
<section class="content-inner-2">
	<div class="container">
		<div class="section-head book-align">
			<h2 class="title mb-0">Special Offers</h2>
			<div class="pagination-align style-1">
				<div class="book-button-prev swiper-button-prev"><i class="fa-solid fa-angle-left"></i>
				</div>
				<div class="book-button-next swiper-button-next"><i class="fa-solid fa-angle-right"></i>
				</div>
			</div>
		</div>
		<div class="swiper-container book-swiper">
			<div class="swiper-wrapper">
				<?php
				// fetch all books;
				$select = mysqli_query($conn, "SELECT * FROM books WHERE price > 13 AND status = 1 LIMIT 8");
				while ($row = mysqli_fetch_assoc($select)) {
				?>
					<div class="swiper-slide">
						<div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
							<?php if (isset($_SESSION['email'])) { // Check if user is logged in 
							?>
								<div class="dz-media">
									<a href="books-detail.php?book_id=<?php echo $row['book_id'] ?>"><img src="./images/<?php echo $row['image'] ?>" alt="/"></a>
								</div>
								<div class="dz-info">
									<h4 class="dz-title"><a href="books-detail.php?book_id=<?php echo $row['book_id'] ?>"><?php echo $row['title'] ?></a></h4>
									<div class="dz-meta">
										<ul class="dz-tags">
											<li><a href="books-catalog.php"><?php echo $row['books_categories'] ?></a></li>
										</ul>
									</div>
								<?php } else { // User not logged in, use JavaScript for SweetAlert 
								?>
									<div class="dz-media">
										<a onclick="showAlert('books-detail.php')" href="#"><img src="./images/<?php echo $row['image'] ?>" alt="/"></a>
									</div>
									<div class="dz-info">
										<h4 class="dz-title"><a onclick="showAlert('books-detail.php')" href="#"><?php echo $row['title'] ?></a></h4>
										<div class="dz-meta">
											<ul class="dz-tags">
												<li><a href="books-catalog.php"><?php echo $row['books_categories'] ?></a></li>
											</ul>
										</div>
									<?php } ?>
									<p><?php echo $row['description'] ?></p>
									<div class="bookcard-footer">
										<form method="POST">
											<input type="hidden" name="product_id" value="<?php echo $row['book_id']; ?>">
											<input type="hidden" name="item_name" value="<?php echo $row['title']; ?>">
											<input type="hidden" name="image" value="<?php echo $row['image']; ?>">
											<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
											<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
											<button type="submit" name="add-to-cart" class="btn btn-secondary box-btn btnhover btnhover2">
												<i class="flaticon-shopping-cart-1 m-r10"></i> Add to Cart
											</button>
										</form>
										<div class="price-details">
											$8.78 <del>$<?php echo $row['price'] ?></del>
										</div>
										<!-- <a href="shop-cart.html" class="btn btn-primary m-t15 btnhover btnhover2"><i class="flaticon-shopping-cart-1 m-r10"></i> Add to cart</a> -->

									</div>
									</div>
								</div>
						</div>
					<?php
				}
					?>
					</div>
			</div>
		</div>
</section>
<!-- Special Offer End -->

<!-- Testimonial -->
<section class="content-inner-2 testimonial-wrapper">
	<div class="container">
		<div class="testimonial">
			<div class="section-head book-align">
				<div>
					<h2 class="title mb-0">Testimonials</h2>
					<p class="m-b0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua</p>
				</div>
				<div class="pagination-align style-1">
					<div class="testimonial-button-prev swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
					<div class="testimonial-button-next swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div class="swiper-container testimonial-swiper">
		<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.1s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Very impresive store. Your book made studying for the ABC certification exams
								a breeze. Thank you very much</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic">
								<img src="images/testimonial1.jpg" alt="">
							</div>
							<div class="info-right">
								<h6 class="testimonial-name">Jason Huang</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.2s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Very impresive store. Your book made studying for the ABC certification exams
								a breeze. Thank you very much</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic radius">
								<img src="images/testimonial2.jpg" alt="">
							</div>
							<div>
								<h6 class="testimonial-name">Miranda Lee</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.3s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Very impresive store. Your book made studying for the ABC certification exams
								a breeze. Thank you very much</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic radius">
								<img src="images/testimonial3.jpg" alt="">
							</div>
							<div>
								<h6 class="testimonial-name">Steve Henry</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.4s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Thank you for filling a niche at an affordable price. Your book was just what
								I was looking for. Thanks again</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic radius">
								<img src="images/testimonial4.jpg" alt="">
							</div>
							<div>
								<h6 class="testimonial-name">Angela Moss</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.5s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Very impresive store. Your book made studying for the ABC certification exams
								a breeze. Thank you very much</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic radius">
								<img src="images/testimonial2.jpg" alt="">
							</div>
							<div>
								<h6 class="testimonial-name">Miranda Lee</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="testimonial-1 wow fadeInUp" data-wow-delay="0.6s">
					<div class="testimonial-info">
						<ul class="dz-rating">
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-yellow"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
							<li><i class="flaticon-star text-muted"></i></li>
						</ul>
						<div class="testimonial-text">
							<p>Very impresive store. Your book made studying for the ABC certification exams
								a breeze. Thank you very much</p>
						</div>
						<div class="testimonial-detail">
							<div class="testimonial-pic">
								<img src="images/testimonial1.jpg" alt="">
							</div>
							<div class="info-right">
								<h6 class="testimonial-name">Jason Huang</h6>
								<span class="testimonial-position">Book Lovers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Testimonial End -->

<!-- Feature Box -->
<section class="content-inner">
	<div class="container">
		<div class="row sp15">
			<div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="icon-bx-wraper style-2 m-b30 text-center">
					<div class="icon-bx-lg">
						<i class="fa-solid fa-users icon-cell"></i>
					</div>
					<div class="icon-content">
						<h2 class="dz-title counter m-b0">125,663</h2>
						<p class="font-20">Happy Customers</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.2s">
				<div class="icon-bx-wraper style-2 m-b30 text-center">
					<div class="icon-bx-lg">
						<i class="fa-solid fa-book icon-cell"></i>
					</div>
					<div class="icon-content">
						<h2 class="dz-title counter m-b0">50,672</h2>
						<p class="font-20">Book Collections</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.3s">
				<div class="icon-bx-wraper style-2 m-b30 text-center">
					<div class="icon-bx-lg">
						<i class="fa-solid fa-store icon-cell"></i>
					</div>
					<div class="icon-content">
						<h2 class="dz-title counter m-b0">1,562</h2>
						<p class="font-20">Our Stores</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.4s">
				<div class="icon-bx-wraper style-2 m-b30 text-center">
					<div class="icon-bx-lg">
						<i class="fa-solid fa-leaf icon-cell"></i>
					</div>
					<div class="icon-content">
						<h2 class="dz-title counter m-b0">457</h2>
						<p class="font-20">Famous Writers</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Feature Box End -->

<!-- Newsletter -->
<section class="py-5 newsletter-wrapper" style="background-image: url('images/bg1.jpg'); background-size: cover;">
	<div class="container">
		<div class="subscride-inner">
			<div class="row style-1 justify-content-xl-between justify-content-lg-center align-items-center text-xl-start text-center">
				<div class="col-xl-7 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
					<div class="section-head mb-0">
						<h2 class="title text-white my-lg-3 mt-0">Subscribe our newsletter for newest books
							updates</h2>
					</div>
				</div>
				<div class="col-xl-5 col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
					<form class="dzSubscribe style-1" action="script/mailchamp.php" method="post">
						<div class="dzSubscribeMsg"></div>
						<div class="form-group">
							<div class="input-group mb-0">
								<input name="dzEmail" required="required" type="email" class="form-control bg-transparent text-white" placeholder="Your Email Address">
								<div class="input-group-addon">
									<button name="submit" value="Submit" type="submit" class="btn btn-primary btnhover">
										<span>SUBSCRIBE</span>
										<i class="fa-solid fa-paper-plane"></i>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Newsletter End -->



<?php
require('includes/footer.php');

?>