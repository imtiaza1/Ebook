<?php
require('includes/header.php');
require('includes/db.php');
require('includes/add-to-cart.php');

?>
<div class="page-content bg-grey">
    <section class="content-inner-1 border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title">Books Catalog</h4>
            </div>
            <div class="row book-grid-row">
                <?php
                // fetch all books;
                $select = mysqli_query($conn, "SELECT * FROM books where status=1");
                while ($row = mysqli_fetch_assoc($select)) {
                ?>
                    <div class="col-book style-1">
                        <div class="dz-shop-card style-1">
                            <div class="dz-media">
                                <img src="./images/<?php echo $row['image'] ?>" alt="book">
                            </div>
                            <div class="bookmark-btn style-2">
                                <form method="post">
                                    <input class="form-check-input" name="checkbox" type="checkbox" id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        <i class="flaticon-heart"></i>
                                    </label>
                                </form>
                            </div>
                            <div class="dz-content">
                                <h5 class="title"><a href="books-detail.php?book_id=<?php echo $row['book_id'] ?>"><?php echo $row['title'] ?></a></h5>
                                <ul class="dz-tags">
                                    <li><a href="books-catalog.php"><?php echo $row['books_categories'] ?></a></li>
                                </ul>
                                <div class="price">
                                    <span class="price-num"> $<?php echo $row['price'] ?></span>
                                </div>
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
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Client Start-->
    <div class="bg-white py-5">
        <div class="container">
            <!--Client Swiper -->
            <div class="swiper client-swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper" id="swiper-wrapper-38c36ffafda2dec5" aria-live="off" style="transform: translate3d(-780px, 0px, 0px); transition-duration: 0ms;">
                    <div class="swiper-slide" role="group" aria-label="1 / 5" style="width: 390px;"><img src="images/client1.svg" alt="client"></div>
                    <div class="swiper-slide swiper-slide-prev" role="group" aria-label="2 / 5" style="width: 390px;"><img src="images/client2.svg" alt="client"></div>
                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="3 / 5" style="width: 390px;"><img src="images/client3.svg" alt="client"></div>
                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="4 / 5" style="width: 390px;"><img src="images/client4.svg" alt="client"></div>
                    <div class="swiper-slide" role="group" aria-label="5 / 5" style="width: 390px;"><img src="images/client5.svg" alt="client"></div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>
    <!-- Client End-->

    <!-- Feature Box -->
    <section class="content-inner">
        <div class="container">
            <div class="row sp15">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
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
                <div class=" col-lg-3 col-md-6 col-sm-6 col-6">
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
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

</div>
<?php
require('includes/footer.php');
?>