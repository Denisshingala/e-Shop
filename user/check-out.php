<?php
session_start();
include('../configuration/config.php');

if (isset($_SESSION['email'])) {
    if ($_SESSION['type'] == 'seller')
        header("location:/e-shop/seller/dashboard.php");
    else if ($_SESSION['type'] == 'admin') {
        header("location:/e-shop/admin/dashboard.php");
    }
}
$error = "";
$success = "";

if (!isset($_SESSION['item']) || !isset($_SESSION['user_id'])) {
    header("location:/e-shop/index.php");
}

include('./action/check-out.php');

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
    <style>
        .body-container {
            height: 500px;
            overflow: auto;
        }

        .body-container::-webkit-scrollbar {
            width: 10px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.2);
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <!-- Error-Success message Start -->
    <?php include('utilities/error-success.php') ?>
    <!-- Error-Success message End -->

    <!-- Navbar Start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- Navbar End -->

    <?php
    $sql = "SELECT * FROM `user` WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $pincode = $row['pincode'];
        $country = $row['country'];
    } else {
        header("location:/e-shop/index.php");
    }

    ?>

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <!-- User Details  -->
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" placeholder="123 Street" value="<?php echo $address ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" placeholder="New Delhi" value="<?php echo $city ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" name="state" placeholder="New Delhi" value="<?php echo $state ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <input class="form-control" type="text" name="country" placeholder="India" value="<?php echo $country ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>PIN Code</label>
                                <input class="form-control" type="text" name="pincode" placeholder="123456" value="<?php echo $pincode ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Product details  -->
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Product Details</h4>
                        <div class="body-container">
                            <?php
                            if (sizeof($_SESSION['item'])) {
                                $totalPrize = 0;
                                for ($i = 0; $i < sizeof($_SESSION['item']); $i++) {
                                    $sql = "SELECT * FROM `product` WHERE product_id=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $_SESSION['item'][$i]['id']);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    if ($res->num_rows > 0) {
                                        $row = $res->fetch_assoc();
                                        $_SESSION['item'][$i]['title'] = $row['title'];
                                        $_SESSION['item'][$i]['price'] = $row['price'];
                                        $_SESSION['item'][$i]['discount'] = $row['discount'];
                                        $_SESSION['item'][$i]['sellingPrice'] = $row['price'] - ($row['price'] * $row['discount'] / 100);
                                        $totalPrize += ($_SESSION['item'][$i]['sellingPrice'] * $_SESSION['item'][$i]['quantity']);
                                        $images = explode(',', $row['image']);
                                        $count = 0;
                            ?>
                                        <div class="container-fluid">

                                            <div class="row px-xl-5">
                                                <!-- Item preview start  -->
                                                <div class="col-lg-5 pb-5" style="height:500px;">
                                                    <div id="product-carousel<?php echo  $row['product_id'] ?>" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner border">
                                                            <?php
                                                            foreach ($images as $image) {
                                                                if ($count == 0) {
                                                                    echo    '<div class="carousel-item active">
                                                                    <img class="w-100" src="../' . $image . '" alt="Image" style="object-fit:contain; height:500px;">
                                                                </div>';
                                                                    $count++;
                                                                } else {
                                                                    echo '  <div class="carousel-item">
                                                                    <img class="w-100" src="../' . $image . '" alt="Image" style="object-fit:contain; height:500px;">
                                                                </div>';
                                                                }
                                                            } ?>
                                                        </div>
                                                        <?php if (sizeof($images) != 1) { ?>
                                                            <a class="carousel-control-prev" href="#product-carousel<?php echo $row['product_id'] ?>" data-slide="prev">
                                                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                                                            </a>
                                                            <a class="carousel-control-next" href="#product-carousel<?php echo $row['product_id'] ?>" data-slide="next">
                                                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- Item preview end  -->

                                                <!-- Item description start  -->
                                                <div class="col-lg-7 pt-3" style="margin-top: 4.5rem;">
                                                    <h3 class="font-weight-semi-bold text-center"><?php echo $_SESSION['item'][$i]['title']; ?></h3>
                                                    <h3 class="font-weight-semi-bold ml-3 my-5 text-center">
                                                        <small class="mr-2" style="color:red;"><del>$ <?php echo $_SESSION['item'][$i]['price']; ?></del></small>
                                                        $ <?php echo $_SESSION['item'][$i]['sellingPrice']; ?>
                                                        <small style="margin-bottom: 100px; !important" class="h6"><?php echo $_SESSION['item'][$i]['discount']; ?>% off</small>
                                                    </h3>
                                                    <div class="ml-3 w-100">
                                                        <?php
                                                        if ($_SESSION['item'][$i]['size'] != NULL) {
                                                            echo "<p> Size :" . $_SESSION['item'][$i]['size'] . "</p>";
                                                        }
                                                        if ($_SESSION['item'][$i]['colour'] != NULL) {
                                                            echo "<p> Colour : " . $_SESSION['item'][$i]['colour'] . "</p>";
                                                        }
                                                        echo "<p> Quantity : " . $_SESSION['item'][$i]['quantity'] . "</p>";
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- Item description end  -->
                                            </div>

                                        </div>
                            <?php } else {
                                        echo "<h2>Product not found!</h2>";
                                    }
                                }
                            } ?>
                        </div>
                    </div>
                </div>

                <!-- Place order  -->
                <div class="col-lg-4 body-container h-75">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Products</h5>
                            <?php foreach ($_SESSION['item'] as $item) { ?>
                                <div class="d-flex justify-content-between">
                                    <p class="text-truncate w-75"><?php echo $item['title'] ?></p>
                                    <p><?php echo $item['sellingPrice'] * $item['quantity'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Payment</h4>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold"><?php echo $totalPrize ?></h5>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" type="submit" name="place_order">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->

    <!-- Footer Start -->
    <?php include('./utilities/footer.php'); ?>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>