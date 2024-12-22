<?php
require('includes/header.php');
require('includes/db.php');
?>
<section class="content-inner-1 border-bottom">
    <div class="container">

        <div class="row book-grid-row">
            <?php
            if (isset($_POST['search'])) {
                // Validate and sanitize search term and category
                $searchTerm = isset($_POST['searchTerm']) ? mysqli_real_escape_string($conn, $_POST['searchTerm']) : '';
                $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';

                if (!empty($searchTerm) && !empty($category)) {
                    // Construct the SQL query
                    $query = "SELECT * FROM books WHERE MATCH(title, description) AGAINST('$searchTerm') AND status = 1 AND books_categories = '$category'";
                    $sql = mysqli_query($conn, $query);

                    if ($sql) {
                        if (mysqli_num_rows($sql) > 0) {
                            while ($row = mysqli_fetch_array($sql)) {
            ?>
                                <div class="col-book style-1">
                                    <div class="dz-shop-card style-1">
                                        <div class="dz-media">
                                            <img src="./images/<?php echo $row['image'] ?>" alt="book">
                                        </div>
                                        <div class="bookmark-btn style-2">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault1">
                                            <label class="form-check-label" for="flexCheckDefault1">
                                                <i class="flaticon-heart"></i>
                                            </label>
                                        </div>
                                        <div class="dz-content">
                                            <?php if (isset($_SESSION['email'])) { // Check if user is logged in 
                                            ?>
                                                <h5 class="title"><a href="books-detail.php?book_id=<?php echo $row['book_id'] ?>"><?php echo $row['title'] ?></a></h5>
                                            <?php } else { // User not logged in, use JavaScript for SweetAlert 
                                            ?>
                                                <h5 class="title"><a onclick="showAlert('books-detail.php')" href="#"><?php echo $row['title'] ?></a></h5>
                                            <?php } ?>
                                            <ul class="dz-tags">
                                                <li><a href="books-catalog.php"><?php echo $row['books_categories'] ?>,</a></li>
                                            </ul>
                                            <ul class="dz-rating">
                                                <li><i class="flaticon-star text-yellow"></i></li>
                                                <li><i class="flaticon-star text-yellow"></i></li>
                                                <li><i class="flaticon-star text-yellow"></i></li>
                                                <li><i class="flaticon-star text-yellow"></i></li>
                                                <li><i class="flaticon-star text-yellow"></i></li>
                                            </ul>
                                            <div class="book-footer">
                                                <div class="price">
                                                    <span class="price-num"><?php echo $row['price'] ?></span>
                                                    <del>$20</del>
                                                </div>
                                                <a href="shop-cart.html" class="btn btn-secondary box-btn btnhover btnhover2"><i class="flaticon-shopping-cart-1 m-r10"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            <?php
                            }
                        } else {
                            echo '
                            <p class="text-danger">No books found matching your search criteria.</p>
                            ';
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo '
                        <p class="text-danger">Search term and category are required.</p>
                        ';
                }
            }
            ?>

        </div>
    </div>
</section>



<?php
require('includes/footer.php');
?>