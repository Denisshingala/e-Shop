<?php
require('../configuration/config.php');
require('action/auth.php');
require('action/delete-product.php');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>e-Shop | Seller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        th,
        td {
            vertical-align: middle !important;
        }

        .newprize {
            color: #B12704;
        }

        .oldprize {
            color: #565959;
            text-decoration: line-through;
        }

        .card-btn {
            width: 100px;
            margin: 3px;
        }

        .modal-dialog {
            max-width: 800px !important;
        }

        label {
            font-weight: bold;
        }

        .product-body {
            height: 22vh;
        }

        .product-desc {
            max-height: 6.5vh !important;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .col-3 {
            width: 24% !important;
        }
    </style>
</head>

<body>
    <?php include('utilities/navbar.php') ?>

    <main class="d-flex">
        <?php include('utilities/side-navbar.php'); ?>
        <div class="main-body" class="p-2 w-100">
            <?php include('utilities/error-success.php') ?>

            <div class="d-flex flex-wrap justify-content-center">

                <!-- product card -->
                <?php
                $sql = "SELECT * FROM product JOIN category ON product.category_id = category.category_id WHERE seller_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION['seller_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $id = 0;
                    while ($row = $result->fetch_assoc()) {
                        $size = $row['size_available'];
                        if ($size == NULL)
                            $size = '--';

                        $colour = $row['colour_available'];
                        if ($colour == NULL)
                            $colour = '--';

                        $sellingPrice = $row['price'] - ($row['price'] * $row['discount'] / 100);
                        $images = explode(',', $row['image']);
                        $count = 0;
                ?>
                        <div class="card m-1" style="width: 18rem;">
                            <div class="card-body text-center">
                                <div id="carouselExampleControls<?php echo $id ?>" class="carousel slide bg-light" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php
                                        foreach ($images as $image) {
                                            if ($count === 0)
                                                echo '<div class="carousel-item active">';
                                            else
                                                echo '<div class="carousel-item" style="object-fit: contain;">';
                                            echo '<img src="../' . $image . '" class="d-block w-100" style=" object-fit:contain; width: 100% !important; height: 30vh !important;" alt="' . $row['title'] . '"/></div>';
                                            $count++;
                                        } ?>
                                    </div>
                                    <?php if ($count != 1) { ?>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?php echo $id ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-secondary opacity-50" style="width:1vw;" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?php echo $id ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon bg-secondary opacity-50" style="width:1vw;" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="product-body">
                                    <h5 class="card-title fw-bold"><?php echo $row['brand'] ?></h5>
                                    <h6 class="product-desc pb-2"><?php echo $row['title'] ?></h6>
                                    <p><span class="newprize h4">$<?php echo $sellingPrice ?></span> <span class="oldprize">$<?php echo $row['price'] ?></span> (<?php echo $row['discount'] ?>% off)</p>
                                </div>

                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class='d-inline'>
                                    <?php echo '<input type="text" name="id" value="' . $row['product_id'] . '" hidden/>'; ?>
                                    <input type="submit" name="delete" class="card-btn btn btn-danger w-100" value="Delete">
                                </form>
                            </div>
                        </div>
                <?php
                        $id++;
                    }
                }
                ?>
            </div>
        </div>

    </main>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

</body>

</html>