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
                        <th>Invoice Number</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Transaction id</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Cash On Delivery</td>
                        <td>Otto</td>
                        <td>Otto</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </main>

</body>

<?php include('./utilities/datatable.php') ?>

</html>