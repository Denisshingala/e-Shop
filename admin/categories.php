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
    <title>e-Shop | Admin</title>

    <?php include('utilities/header.php') ?>

    <link rel="stylesheet" href="css/style.css">
    <style>
        th,
        td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <?php include('utilities/navbar.php') ?>

    <main class="d-flex">
        <?php include('utilities/side-navbar.php') ?>

        <div class="p-4">

            <form action="./action/add-category.php" method="POST" class="p-2 mb-5">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="category" id="category" placeholder="New Category">
                </div>

                <button type="submit" id="add-new-category-btn" name="add-new-category-btn" class="btn btn-primary">Add new category</button>
            </form>


            <table class="table table-bordered text-center table-responsive table-striped">
                <thead>
                    <tr style="background-color: rgb(95, 162, 240);">
                        <th>#</th>
                        <th style="width:400px;">Categories</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../configuration/config.php');

                    $sql = "SELECT * FROM category";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
									<td>' . $counter . '</td>
									<td>' . $row['category_name'] . '</td>
                                </tr>';
                            $counter++;
                        }
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </main>

    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>