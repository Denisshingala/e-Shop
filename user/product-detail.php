<?php
include('../configuration/config.php');
include('../action/auth.php');

if (!isset($_GET['pid'])) {
    header("location: ../index.php");
} else {
    $productID = $_GET['pid'];
    $sql = "SELECT * FROM `product` WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows <= 0) {
        header("location:/e-shop");
    }
    $stmt->close();
}

if (isset($_POST['review-btn']) && $_POST['review-description'] != '') {
    $description = $conn->real_escape_string($_POST['review-description']);
    $today = date("Y-m-d");

    $sql = "INSERT INTO reviews (product_id, user_id, description, review_date) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $productID, $_SESSION['user_id'], $description, $today);
    if ($stmt->execute())
        $success = "Thanks for valuable feedback!";
    else
        $error = "Something went wrong on server!";
}

require('./action/add-cart.php');

if (isset($_POST['place_order'])) {
    $_SESSION['item'][0]['id'] = $_GET['pid'];
    $_SESSION['item'][0]['quantity'] = mysqli_real_escape_string($conn, $_POST['p_quantity']);
    if (isset($_POST['p_colour']))
        $_SESSION['item'][0]['colour'] = mysqli_real_escape_string($conn, $_POST['p_colour']);
    else
        $_SESSION['item'][0]['colour'] = NULL;

    if (isset($_POST['p_size']))
        $_SESSION['item'][0]['size'] = mysqli_real_escape_string($conn, $_POST['p_size']);
    else
        $_SESSION['item'][0]['size'] = NULL;
    header("location:/e-shop/user/check-out.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-shop</title>
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

    <!-- Customized Bootstrap 4 Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <!-- Error-Success message Start -->
    <?php include('utilities/error-success.php') ?>
    <!-- Error-Success message End -->

    <!-- Navbar Start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- Navbar End -->

    <hr>

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5" style="height:500px;">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">

                        <?php
                        $sql = "SELECT * FROM product WHERE product_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $productID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();

                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $discount = $row['discount'];
                            $sizeAvailable = $row['size_available'];
                            $colourAvailable = $row['colour_available'];
                            $categoryID = $row['category_id'];

                            $description =
                                str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n", "\\\""), "<br/>", $description);

                            $images = explode(',', $row['image']);
                            $count = 0;
                            foreach ($images as $image) {
                                if ($count == 0) {
                                    echo '<div class="carousel-item active">
                                    <img class="w-100" src="../' . $image . '" alt="Image" style="object-fit:contain; height:500px;">
                                    </div>';
                                    $count++;
                                } else {
                                    echo '<div class="carousel-item">
                                    <img class="w-100" src="../' . $image . '" alt="Image" style="object-fit:contain; height:500px;">
                                    </div>';
                                }
                            }
                        }
                        $stmt->close(); ?>
                    </div>
                    <?php if (sizeof($images) != 1) { ?>
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo $title; ?></h3>
                <h3 class="font-weight-semi-bold"><small class="mr-2" style="color:red;">-<?php echo $discount; ?>% </small> $ <?php echo ($row['price'] - ($row['price'] * $row['discount'] / 100)); ?></h3>
                <p><small style="margin-bottom: 100px; !important">M.R.P. <del>$ <?php echo $price; ?></del></small></p>

                <p><span style="font-weight:bold; color:black; font-size:1.2rem; ">Brand : </span><?php echo $row['brand']; ?></p>

                <p class="my-5" style="line-height:20px;"><?php echo $description; ?></p>

                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>" onsubmit="return verifyItem()">
                    <input type="number" name="p_id" value=<?php echo $productID; ?> hidden />
                    <?php
                    if ($sizeAvailable) {
                        $sizes = explode(',', $sizeAvailable); ?>
                        <div class="d-flex mb-3">
                            <p class="text-dark font-weight-medium mb-0 mr-3 mt-1">Sizes:</p>
                            <div class="d-flex flex-row">
                                <?php foreach ($sizes as $size) { ?>
                                    <div class="my-1 mx-2">
                                        <input type="radio" name="p_size" value="<?php echo $size ?>" required>
                                        <label for="size"><?php echo $size ?></label>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    <?php } ?>

                    <?php
                    if ($colourAvailable) {
                        $colours = explode(',', $colourAvailable); ?>

                        <div class="d-flex mb-3">
                            <p class="text-dark font-weight-medium mb-0 mr-3">Colours:</p>
                            <div class="d-flex flex-row">
                                <?php foreach ($colours as $colour) { ?>
                                    <div class="my-1 mx-2">
                                        <input type="radio" name="p_colour" value="<?php echo $colour ?>" required>
                                        <label for="colour"><?php echo $colour ?></label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="d-flex align-items-center mb-4 pt-2" style="width: 380px;">
                        <div class="input-group quantity mr-3" style="width: 200px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus h-100" onclick="decQuantity()" <?php echo isset($_SESSION['user_id']) ? "" : "disabled" ?>>
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center" value="1" id="quantity" name="p_quantity" min="1" <?php echo isset($_SESSION['user_id']) ? "" : "disabled" ?> required>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus h-100" onclick="incQuantity()" <?php echo isset($_SESSION['user_id']) ? "" : "disabled" ?>>
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" <?php echo isset($_SESSION['user_id']) ? "" : "disabled" ?> name="add_cart" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex flex-row mb-3" style="width: 370px;">
                        <hr class="border w-50 mr-3">
                        <div class="align-middle m-0 py-1">OR</div>
                        <hr class="border w-50 ml-3">
                    </div>
                    <button class="btn btn-primary px-3" style="width: 370px;" <?php echo isset($_SESSION['user_id']) ? "" : "disabled" ?> name="place_order" type="submit"><i class="fa fa-shopping-bag"></i> Place an Order</button>
                </form>
            </div>
        </div>

        <script>
            const quantity = document.getElementById('quantity');
            const incQuantity = () => {
                quantity.value++;
            }
            const decQuantity = () => {
                if (quantity.value > 1)
                    quantity.value--;
            }
            const verifyItem = () => {
                if (quantity.value <= 0) {
                    alert("Error ! Item quantity should be more than 0");
                    return false;
                }
            }
        </script>


        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <?php
                    $sql = "SELECT user.profile_image, user.name, reviews.review_date, reviews.description FROM reviews JOIN user ON user.user_id = reviews.user_id WHERE product_id=? ORDER BY RAND()";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $productID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $noOfReviews = $result->num_rows;
                    ?>
                    <h3 style="color:#D19C97;">Reviews (<?php echo $noOfReviews; ?>)</h3>
                </div>

                <div id="review-section">
                    <div class="row p-3">
                        <div class="col-md-6">

                            <?php
                            $noOfReviews < 3 ? $n = $noOfReviews : $n = 3;
                            for ($i = 0; $i < $n; ++$i) {
                                $row = $result->fetch_assoc();
                                if ($row['profile_image'] === '')
                                    $src = "https://bootdey.com/img/Content/avatar/avatar7.png";
                                else
                                    $src = "../" . $row['profile_image'];

                                echo '<div class="media mb-4">
                                <img src="' . $src . '" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px; height: 45px; border-radius:50%;">
                                <div class="media-body">
                                    <h6>' . $row['name'] . '<small> - <i>' . $row['review_date'] . '</i></small></h6>
                                    <p>' . $row['description'] . '</p>
                                </div>
                            </div>';
                            }

                            if ($noOfReviews > 3)
                                echo '<a href="review.php?pid=' . $productID . '" style="float:right; font-size:18px;">More Reviews >></a>';
                            ?>
                        </div>

                        <?php
                        if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') {
                        ?>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="review-description">Your Review *</label>
                                        <textarea id="review-description" name="review-description" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" name="review-btn" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        <?php
                        } else {
                        ?>
                            <button class="btn btn-primary px-3 align-center" style="height:50px;">
                                <a href="/e-shop/login.php" style="color:black;">Login to review</a>
                            </button>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5 pb-3 justify-content-center">

            <?php
            $sql1 = "SELECT * FROM product WHERE category_id=? ORDER BY RAND() LIMIT 5";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("i", $categoryID);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $images = explode(',', $row1['image']);

                    echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-4" style="height:450px;">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:250px;">
                                            <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:250px;" src="../' . $images[0] . '" alt="">
                                        </div>
                                        <div class="card-body border-left border-right text-center px-3 pt-4 pb-3">
                                            <h6 class="text-truncate mb-3">' . $row1['title'] . '</h6>
                                            <div class="d-flex justify-content-center">
                                                <h6>$ ' . ($row1['price'] - ($row1['price'] * $row1['discount'] / 100)) . '</h6>
                                                <small class="text-muted ml-2"><del>$ ' . $row1['price'] . '</del></small>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-light border">';

                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="user/product-detail.php?pid=' . $row1['product_id'] . '" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <form method="post">
                                <input type="number" value=' . $row1['product_id'] . ' name="p_id" hidden/>
                                <input type="number" value=1 name="p_quantity" hidden/>
                                <button type="submit" name="add_cart" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                            </form>';
                    } else {
                        echo '<a href="user/product-detail.php?pid=' . $row1['product_id'] . '" class="btn btn-sm text-dark p-0 w-100">
                            <i class="fas fa-eye text-primary mr-1"></i>View Detail</a>';
                    }

                    echo '</div></div></div>';
                }
            }
            ?>

        </div>
    </div>
    <!-- Products End -->


    <!-- Footer Start -->
    <?php include('./utilities/footer.php'); ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>