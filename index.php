<?php
require('./configuration/config.php');
require('./action/auth.php');
require('./user/action/add-cart.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="./images/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
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
    <?php include('user/utilities/error-success.php') ?>
    <!-- Error-Success message End -->


    <!-- navbar start -->
    <?php include('user/utilities/navbar.php'); ?>
    <!-- navbar end -->

    <!-- Carousel Start -->
    <div id="header-carousel" class="carousel slide my-3" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="images/banners/banner-20.avif" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Quality Product</h3>
                        <!-- <a href="" class="btn btn-light py-2 px-3">Shop Now</a> -->
                    </div>
                </div>
            </div>
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="images/banners/banner-4.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Shoes</h3>
                        <!-- <a href="" class="btn btn-light py-2 px-3">Shop Now</a> -->
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="images/banners/banner-22.avif" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                        <!-- <a href="" class="btn btn-light py-2 px-3">Shop Now</a> -->
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Top Categories</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            $sql = "SELECT * FROM category LIMIT 6";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $category = $row['category_name'];

                    $sql3 = "SELECT count(*) as countproduct FROM product JOIN category ON product.category_id = category.category_id WHERE category_name=?";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->bind_param("s", $category);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();
                    $row3 = $result3->fetch_assoc();
                    $countProduct = $row3['countproduct'];

                    $sql2 = "SELECT product.image FROM product JOIN category ON product.category_id = category.category_id WHERE category.category_name=? LIMIT 1";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bind_param("s", $category);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $images = explode(',', $row2['image']);
                        $image = $images[0];

                        echo '<div class="col-lg-4 col-md-6 pb-1">
                            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                                <p class="text-right">' . $countProduct . ' Products</p>
                                <a href="user/products.php?cid=' . $row['category_id'] . '&page_no=1" class="cat-img position-relative overflow-hidden mb-3">
                                    <img class="img-fluid" src="./' . $image . '" alt="" style="width:100%; height:250px; object-fit:contain;">
                                </a>
                                <h5 class="font-weight-semi-bold m-0">' . $category . '</h5>
                            </div>
                        </div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trendy Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">

            <?php
            $sql = "SELECT * FROM product ORDER BY RAND() LIMIT 8";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $images = explode(',', $row['image']);

                    echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-4" style="height:450px;">
                                    <div class="card product-item border-0 mb-4">
                                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:250px;">
                                            <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:250px;" src="./' . $images[0] . '" alt="">
                                        </div>
                                        <div class="card-body border-left border-right text-center px-3 pt-4 pb-3">
                                            <h6 class="text-truncate mb-3">' . $row['title'] . '</h6>
                                            <div class="d-flex justify-content-center">
                                                <h6>$ ' . ($row['price'] - ($row['price'] * $row['discount'] / 100)) . '</h6>
                                                <small class="text-muted ml-2"><del>$ ' . $row['price'] . '</del></small>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between bg-light border">';

                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="user/product-detail.php?pid=' . $row['product_id'] . '" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <form method="post">
                                <input type="number" value=' . $row['product_id'] . ' name="p_id" hidden/>
                                <input type="number" value=1 name="p_quantity" hidden/>
                                <button type="submit" name="add_cart" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                            </form>';
                    } else {
                        echo '<a href="user/product-detail.php?pid=' . $row['product_id'] . '" class="btn btn-sm text-dark p-0 w-100">
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
    <?php include('./user/utilities/footer.php'); ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
</body>

</html>