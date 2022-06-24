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
                        <th style="width:200px;">Description</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Images</th>
                        <th>Sizes</th>
                        <th>Colours</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <img src="../images/logo.png" alt="" width="75" height="75">
                        </td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <a href="#" style="color:green; font-weight:bold; text-decoration:underline; cursor:pointer;">Edit</a>
                        </td>
                        <td>
                            <a href="#" style="color:red; font-weight:bold; text-decoration:underline; cursor:pointer;">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </main>

</body>

<?php include('./utilities/datatable.php') ?>

</html>