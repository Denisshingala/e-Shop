<!-- This will contain category wise products -->
<?php
include('./configuration/config.php');
$categoryID = $_GET['cid'];
$pageNo = $_GET['page_no'];
$limitPerPage = 2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- Navbar End -->

    <hr>

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Price Range</h5>
                    <form>

                        <?php
                        include('./action/calculateRange.php');

                        $sql = "SELECT min(price) as minprice, max(price) as maxprice FROM product WHERE category_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $max = $row['maxprice'];
                            $min = $row['minprice'];

                            $arr = calculateRange($min, $max);

                            for ($i = 0; $i < 4; $i++) {
                                $minValue = $arr[$i];
                                $maxValue = $arr[$i + 1];
                        ?>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" class="custom-control-input" id="price-<?php echo $i + 1; ?>" onclick="fetchData(<?php echo $minValue; ?>, <?php echo $maxValue; ?>)">

                                    <label class="custom-control-label" for="price-<?php echo $i + 1; ?>">&#x20b9;<?php echo $minValue; ?> - &#x20b9;<?php echo $maxValue; ?></label>
                                    <span class="badge border font-weight-normal">150</span>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-above">
                            <label class="custom-control-label" for="price-1">&#x20b9;<?php echo $arr[4]; ?> and above</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>

                    </form>
                </div>
                <!-- Price End -->

                <!-- Brand filter Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Brand</h5>
                    <form>

                        <?php
                        $sql = "SELECT DISTINCT(brand) FROM product WHERE category_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $categories = '';
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between py-1">
                                    <input type="checkbox" class="custom-control-input brand" id="color-5">
                                    <label class="custom-control-label" for="color-5">' . $row['brand'] . '</label>
                                    <span class="badge border font-weight-normal">168</span>
                                </div>';
                            }
                        }
                        ?>


                    </form>
                </div>
                <!-- Brand filter End -->
            </div>

            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">

                    <?php
                    $offset = ($pageNo - 1) * $limitPerPage;

                    $sql = "SELECT * FROM product WHERE category_id = ? LIMIT {$offset},{$limitPerPage}";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $categoryID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $cards = "";
                        while ($row = $result->fetch_assoc()) {
                            $images = explode(',', $row['image']);

                            echo '<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height:250px;">
                                            <img class="img-fluid w-100" src="./' . $images[0] . '" style="object-fit:contain; height:250px;" alt="Product">
                                        </div>
                                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3 px-3">
                                            <h6 class="text-truncate mb-3">' . $row['title'] . '</h6>
                                            <div class="d-flex justify-content-center">
                                                <h6>&#x20b9 ' . ($row['price'] - ($row['price'] * $row['discount'] / 100)) . '</h6>
                                                <h6 class="text-muted ml-2"><del>&#x20b9 ' . $row['price'] . '</del></h6>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-light border">
                                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                    ?>

                    <!-- Pagination Start -->
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item">
                                    <?php
                                    $hrefNext = '';
                                    $disabled = '';
                                    if ($pageNo == 1) {
                                        $disabled = 'disabled';
                                    } else {
                                        $hrefPrev = 'products.php?cid=' . $categoryID . '&page_no=' . ($pageNo - 1);
                                    }
                                    ?>

                                    <a class="page-link" href="<?php echo $hrefPrev; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>

                                <?php
                                $sql = "SELECT * FROM product WHERE category_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $categoryID);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $totalNoOfRows = $result->num_rows;
                                    $li = "";
                                    $totalPages = ceil($totalNoOfRows / $limitPerPage);

                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        ($pageNo == $i) ? $active = 'active' : $active = '';

                                        $li .= '<li class="page-item ' . $active . '"><a class="page-link" href="products.php?cid=' . $categoryID . '&page_no=' . $i . '">' . $i . '</a></li>';
                                    }
                                    echo $li;
                                }
                                ?>

                                <?php
                                $hrefNext = '';
                                $disabled = '';
                                if ($pageNo == $totalPages) {
                                    $disabled = 'disabled';
                                } else {
                                    $hrefNext = 'products.php?cid=' . $categoryID . '&page_no=' . ($pageNo + 1);
                                }
                                ?>

                                <li class="page-item <?php echo $disabled; ?>">
                                    <a class="page-link" href="<?php echo $hrefNext; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination End -->
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>