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

        <div class="p-2">

            <table class="table table-bordered table-responsive table-striped text-center my-auto" id="myTable">
                <thead>
                    <tr style="background-color: rgb(95, 162, 240);">
                        <th>Product Title</th>
                        <th style="max-width:300px;">Description</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Images</th>
                        <th>Selling Price</th>
                        <th>Sizes</th>
                        <th>Colours</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM product JOIN category ON product.category_id = category.category_id WHERE seller_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $_SESSION['seller_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $size = $row['size_available'];
                            if ($size == NULL)
                                $size = '--';

                            $colour = $row['colour_available'];
                            if ($colour == NULL)
                                $colour = '--';

                            $sellingPrice = $row['price'] - ($row['price'] * $row['discount'] / 100);

                            $images = explode(',', $row['image']);

                            $imageString = "";
                            foreach($images as $image) {
                                $imageString .= '<img src="../' . $image . '" width="100" height="80"> <br><br>';
                            }

                            echo '<tr>
									<td>' . $row['title'] . '</td>
									<td style="max-width:300px; word-wrap: break-word;">' . $row['description'] . '</td>
                                    <td>' . $row['brand'] . '</td>
                                    <td>' . $row['category_name'] . '</td>
									<td>' . $row['price'] . '</td>
									<td>' . $row['discount'] . '%</td>
                                    <td>' . $imageString . '</td>
									<td>' . $sellingPrice . '</td>
									<td>' . $size . '</td>
                                    <td>' . $colour . '</td>
                                    <td>
                                        <a href="#" style="color:green; font-weight:bold; text-decoration:underline; cursor:pointer;">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#" style="color:red; font-weight:bold; text-decoration:underline; cursor:pointer;">Delete</a>
                                    </td>
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