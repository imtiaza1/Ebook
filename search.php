<?php
require('includes/header.php');
require('includes/db.php');
?>
<section class="content-inner-1 border-bottom">
    <div class="container">

        <div class="row book-grid-row">
    <?php
    if (isset($_POST['search'])) {
        // Validate and sanitize input
        $searchTerm = trim($_POST['searchTerm'] ?? '');
        $category = trim($_POST['category'] ?? '');

        if (!empty($searchTerm) && !empty($category)) {
            // Escape search inputs
            $searchTermEsc = mysqli_real_escape_string($conn, $searchTerm);
            $categoryEsc = mysqli_real_escape_string($conn, $category);

            // Construct query safely
            $query = "
                SELECT * FROM books 
                WHERE MATCH(title, description) AGAINST('$searchTermEsc') 
                AND status = 1 
                AND books_categories = '$categoryEsc'
            ";

            $sql = mysqli_query($conn, $query);

            if ($sql && mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    ?>
                    <div class="col-book style-1">
                        <div class="dz-shop-card style-1">
                            <div class="dz-media">
                                <img src="./images/<?php echo htmlspecialchars($row['image']); ?>" alt="book">
                            </div>
                            <div class="bookmark-btn style-2">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault<?php echo $row['book_id']; ?>">
                                <label class="form-check-label" for="flexCheckDefault<?php echo $row['book_id']; ?>">
                                    <i class="flaticon-heart"></i>
                                </label>
                            </div>
                            <div class="dz-content">
                                <?php if (isset($_SESSION['email'])) { ?>
                                    <h5 class="title">
                                        <a href="books-detail.php?book_id=<?php echo urlencode($row['book_id']); ?>">
                                            <?php echo htmlspecialchars($row['title']); ?>
                                        </a>
                                    </h5>
                                <?php } else { ?>
                                    <h5 class="title">
                                        <a onclick="showAlert('books-detail.php')" href="#">
                                            <?php echo htmlspecialchars($row['title']); ?>
                                        </a>
                                    </h5>
                                <?php } ?>
                                <ul class="dz-tags">
                                    <li>
                                        <a href="books-catalog.php"><?php echo htmlspecialchars($row['books_categories']); ?></a>
                                    </li>
                                </ul>
                                <ul class="dz-rating">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <li><i class="flaticon-star text-yellow"></i></li>
                                    <?php endfor; ?>
                                </ul>
                                <div class="book-footer">
                                    <div class="price">
                                        <span class="price-num">$<?php echo htmlspecialchars($row['price']); ?></span>
                                        <del>$20</del>
                                    </div>
                                    <a href="shop-cart.html" class="btn btn-secondary box-btn btnhover btnhover2">
                                        <i class="flaticon-shopping-cart-1 m-r10"></i> Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="text-danger">No books found matching your search criteria.</p>';
            }
        } else {
            echo '<p class="text-danger">Search term and category are required.</p>';
        }
    }
    ?>
</div>

    </div>
</section>



<?php
require('includes/footer.php');
?>