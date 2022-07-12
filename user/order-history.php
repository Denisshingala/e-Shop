<?php
include('../configuration/config.php');
include('../action/auth.php');
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

    <body>
        <!-- Error-Success message Start -->
        <?php include('./utilities/error-success.php') ?>
        <!-- Error-Success message End -->

        <!-- navbar start -->
        <?php include('./utilities/navbar.php'); ?>
        <!-- navbar end -->

        <!-- Page Header Start -->
        <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Shopping Cart</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Cart Start -->
        <div class="container-fluid pt-5">
            <div class="row px-xl-5">
                <!-- Cart table end  -->
                <div class="table-responsive mb-5 w-100">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php
                            // fetch data of order History
                            $sql = "SELECT * FROM `order_details` JOIN `orders` ON `order_details`.`order_id`=`orders`.`order_id` WHERE `orders`.`user_id`=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['user_id']);

                            // fetch product details
                            $fetch_product_details = $conn->prepare("SELECT title FROM product WHERE product_id=?");
                            $fetch_product_details->bind_param("i", $p_id);

                            $stmt->execute();
                            $res = $stmt->get_result();
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    $p_id = $row['product_id'];
                                    $fetch_product_details->execute();
                                    $p_res = $fetch_product_details->get_result();
                                    $p_row = $p_res->fetch_assoc();
                            ?>
                                    <tr class="align-middle">
                                        <td class="align-middle"><?php echo $row['order_date'] ?></td>
                                        <td class="align-middle">
                                            <a href="/e-shop/user/product-detail.php?pid=<?php echo $row['product_id'] ?>">
                                                <?php echo $p_row['title'] ?>
                                            </a>
                                        </td>
                                        <td class="align-middle"><?php echo $row['quantity'] ?></td>
                                        <td class="align-middle"><?php echo $row['price'] ?></td>
                                        <td class="align-middle"><?php echo $row['size'] == "NULL" ? "-" : $row['size'] ?></td>
                                        <td class="align-middle"><?php echo $row['colour'] == "NULL" ? "-" : $row['colour'] ?></td>
                                    </tr>

                                <?php }
                            } else { ?>
                                <tr class="align-middle">
                                    <td colspan="6">No Data Found!</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <?php include('./utilities/footer.php'); ?>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    </body>

</html>