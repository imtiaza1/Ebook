<?php
require('includes/header.php');
require('includes/add-to-cart.php');
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $select_book = "SELECT * FROM books WHERE book_id='$book_id'";
    $sql = mysqli_query($conn, $select_book);
    $result = mysqli_num_rows($sql);
    if ($result > 0) {
        while ($row = mysqli_fetch_array($sql)) {
            $book_image = $row['image'];
            $book_id = $row['book_id'];
            $book_author = $row['author'];
            $book_title = $row['title'];
            $book_desc = $row['description'];
            $book_price = $row['price'];
            $book_format = $row['format'];
        }
    } else {
        echo '<script>window.location.href = "index.php";</script>';
    }
} else {
    echo '<script>window.location.href = "index.php";</script>';
}

?>
<div class="page-content bg-grey">
    <section class="content-inner-1">
        <div class="container">
            <div class="row book-grid-row style-4 m-b60">
                <div class="col">
                    <div class="dz-box">
                        <div class="dz-media">
                            <img src="./images/<?php echo $book_image; ?>" alt="book">
                        </div>
                        <div class="dz-content">
                            <div class="dz-header">
                                <h3 class="title"><?php echo $book_title; ?></h3>
                            </div>
                            <div class="dz-body">
                                <div class="book-detail">
                                    <ul class="book-info">
                                        <li>
                                            <div class="writer-info">
                                                <img src="images/portfolio2.png" alt="book">
                                                <div>
                                                    <span>Writen by</span><?php echo $book_author; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <p class="text-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                                <p class="text-2"><?php echo $book_desc; ?></p>
                                <div class="book-footer">
                                    <div class="price">
                                        <h5>$<?php echo $book_price; ?></h5>
                                        <p class="p-lr10">$70.00</p>
                                    </div>
                                    <div class="product-num">
                                        <form method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $book_id; ?>">
                                            <input type="hidden" name="item_name" value="<?php echo $book_title; ?>">
                                            <input type="hidden" name="image" value="<?php echo $book_image; ?>">
                                            <input type="hidden" name="price" value="<?php echo $book_price; ?>">
                                            <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                            <button type="submit" name="add-to-cart" class="btn btn-secondary box-btn btnhover btnhover2">
                                                <i class="flaticon-shopping-cart-1 m-r10"></i> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <div class="product-description tabs-site-button">
                        <ul class="nav nav-tabs">
                            <li><a data-bs-toggle="tab" href="#graphic-design-1" class="active">Details Product</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="graphic-design-1" class="tab-pane show active">
                                <table class="table border book-overview">
                                    <tbody>
                                        <tr>
                                            <th>Book Title</th>
                                            <td><?php echo $book_title; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Author</th>
                                            <td><?php echo $book_author; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ediiton Language</th>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <th>Book Format</th>
                                            <td><?php echo $book_format; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pages</th>
                                            <td>520</td>
                                        </tr>
                                        <tr class="tags">
                                            <th>Tags</th>
                                            <td>
                                                <a href="javascript:void(0);" class="badge">Drama</a>
                                                <a href="javascript:void(0);" class="badge">Advanture</a>
                                                <a href="javascript:void(0);" class="badge">Survival</a>
                                                <a href="javascript:void(0);" class="badge">Biography</a>
                                                <a href="javascript:void(0);" class="badge">Trending2022</a>
                                                <a href="javascript:void(0);" class="badge">Bestseller</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mt-5 mt-xl-0">
                    <div class="widget">
                        <h4 class="widget-title">Related Books</h4>
                        <div class="row">
                            <?php
                            // fetch all related books;
                            $select = mysqli_query($conn, "SELECT * FROM books WHERE price > 13 AND status = 1 LIMIT 3");
                            while ($row = mysqli_fetch_assoc($select)) {
                            ?>
                                <div class="col-xl-12 col-lg-6">
                                    <div class="dz-shop-card style-5">
                                        <div class="dz-media">
                                            <img src="./images/<?php echo $row['image'] ?>" alt="">
                                        </div>
                                        <div class="dz-content">
                                            <h5 class="subtitle"><?php echo $row['title'] ?></h5>
                                            <ul class="dz-tags">
                                                <li><?php echo $row['books_categories'] ?></li>
                                            </ul>
                                            <div class="price">
                                                <span class="price-num">$<?php echo $row['price'] ?></span>
                                                <del>$38.4</del>
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
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Start-->
    <div class="bg-white py-5">
        <div class="container">
            <!--Client Swiper -->
            <div class="swiper client-swiper swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper" id="swiper-wrapper-3129d612ec1129b4" aria-live="off" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5" style="width: 390px;"><img src="images/client1.svg" alt="client"></div>
                    <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 5" style="width: 390px;"><img src="images/client2.svg" alt="client"></div>
                    <div class="swiper-slide" role="group" aria-label="3 / 5" style="width: 390px;"><img src="images/client3.svg" alt="client"></div>
                    <div class="swiper-slide" role="group" aria-label="4 / 5" style="width: 390px;"><img src="images/client4.svg" alt="client"></div>
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