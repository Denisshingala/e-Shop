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
                        <th>Product Title</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Colour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orders JOIN order_details ON orders.order_id = order_details.order_id JOIN product ON product.product_id = order_details.product_id JOIN category ON category.category_id = product.category_id JOIN seller ON seller.seller_id = product.seller_id WHERE seller.seller_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $_SESSION['seller_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $temp = '';
                        while ($row = $result->fetch_assoc()) {
                            if ($row['size'] == "NULL") 
                                $size = '-';
                            else
                                $size = $row['size'];

                            if ($row['colour'] == "NULL")
                                $colour = '-';
                            else
                                $colour = $row['colour'];

                            // if ($temp != '' && $temp == $row['order_id']) {
                            //     echo '<tr>
                            //     <td></td>';
                            // }
                            // else {
                            //     $temp = $row['order_id'];
                            //     echo '<tr>
                            //     <td>' . $row['order_id'] . '</td>';
                            // }

                            echo '<tr>
                                <td>' . $row['order_id'] . '</td>
                                <td style="width:300px;">' . $row['title'] . '</td>
                                <td>' . $row['brand'] . '</td>
                                <td>' . $row['category_name'] . '</td>
                                <td>' . $row['quantity'] . '</td>
                                <td>' . $size . '</td>
                                <td>' . $colour . '</td>
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