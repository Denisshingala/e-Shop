<?php
require('../configuration/config.php');
require('action/auth.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>e-Shop | Seller</title>

    <?php include('utilities/header.php') ?>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('utilities/navbar.php') ?>

    <main class="d-flex">
        <?php include('utilities/side-navbar.php') ?>

        <div class="main-body">

        <div class="container pt-5" style="padding-left:50px;">
                <div class="row align-items-stretch">
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Number of users
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <?php
                                $sql = "SELECT COUNT(*) as row FROM `user`";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                echo $row['row'];
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Number of seller
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <?php
                                $sql = "SELECT COUNT(*) as row FROM `seller`";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                echo $row['row'];
                                $stmt->close();
                                ?>
                            </span>
                            <!-- <span class="hind-font caption-12 c-dashboardInfo__subInfo">Last month: €30</span> -->
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Number of Item
                            </h4><span class="hind-font caption-12 c-dashboardInfo__count">
                                <?php
                                $sql = "SELECT COUNT(*) as row FROM `product` WHERE seller_id=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $_SESSION['seller_id']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                echo $row['row'];
                                $stmt->close();
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="c-dashboardInfo col-lg-3 col-md-6">
                        <div class="wrap">
                            <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                Number of orders
                            </h4>
                            <span class="hind-font caption-12 c-dashboardInfo__count">
                                <?php
                                $sql = "SELECT COUNT(*) as row FROM orders JOIN order_details ON orders.order_id = order_details.order_id JOIN product ON product.product_id = order_details.product_id JOIN category ON category.category_id = product.category_id JOIN seller ON seller.seller_id = product.seller_id WHERE seller.seller_id=? ORDER BY orders.order_id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $_SESSION['seller_id']);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                echo $row['row'];
                                $stmt->close();
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>