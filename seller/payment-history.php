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
    <style>
        th,
        td {
            vertical-align: middle !important;
        }
    </style>
</head>

<body>
    <?php include('utilities/navbar.php') ?>

    <main class="d-flex">
        <?php include('utilities/side-navbar.php') ?>

        <div class="main-body" class="p-2">

            <table class="table table-bordered table-responsive table-striped text-center my-auto" id="myTable">
                <thead>
                    <tr style="background-color: rgb(95, 162, 240);">
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT orders.order_id, SUM(order_details.price * order_details.quantity) as total_price, orders.order_date FROM orders JOIN order_details ON order_details.order_id = orders.order_id JOIN product ON product.product_id = order_details.product_id JOIN seller ON seller.seller_id = product.seller_id WHERE seller.seller_id=? GROUP BY order_details.order_id ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $_SESSION['seller_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . $row['order_id'] . '</td>
                                    <td>Cash On Delivery</td>
                                    <td>' . $row['order_date'] . '</td>
                                    <td>' . number_format((float)$row['total_price'], 2, '.', '') . '</td>
                                </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

</body>

<?php include('./utilities/datatable.php') ?>

</html>