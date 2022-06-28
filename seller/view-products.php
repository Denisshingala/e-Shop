<?php
require('../configuration/config.php');
require('action/auth.php');
require('action/delete-product.php');
require('action/update-product.php');

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
        <div class="p-2 w-100">
            <?php include('utilities/error-success.php') ?>

            <div class="d-flex flex-wrap">

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
                                    <p><span class="newprize h4">&#8377;<?php echo $sellingPrice ?></span> <span class="oldprize">&#8377;<?php echo $row['price'] ?></span> (<?php echo $row['discount'] ?>% off)</p>
                                </div>

                                <!-- Model form  -->
                                <button type="button" class="card-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row['product_id'] ?>">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade text-left" id="staticBackdrop<?php echo $row['product_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update product details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <div class="modal-body bg-light">
                                                    <input type="text" name="id" value="<?php echo $row['product_id'] ?>" hidden />
                                                    <div class="form-group mb-4">
                                                        <label for="title">Product Title</label>
                                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $row['title'] ?> " required>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="description">Product Description</label>
                                                        <br><textarea name="description" id="description" cols="135" rows="4" class="form-control" style="resize: none;"><?php echo $row['description'] ?></textarea>
                                                    </div>

                                                    <div class="form-row d-flex justify-content-around mb-4">
                                                        <div class="form-group col-3">
                                                            <label for="brand">Brand Name</label>
                                                            <input type="text" class="form-control" name="brand" id="brand" value="<?php echo $row['brand'] ?> ">
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <label for="category">Category</label>
                                                            <select id="category" name="category" class="form-control" value="<?php echo $row['category_id'] ?> " required>
                                                                <option disabled> - Select - </option>
                                                                <?php
                                                                $sql1 = "SELECT * FROM category";
                                                                $stmt1 = $conn->prepare($sql1);
                                                                $stmt1->execute();
                                                                $result1 = $stmt1->get_result();
                                                                if ($result1->num_rows > 0) {
                                                                    while ($row1 = $result1->fetch_assoc()) {
                                                                        if ($row1['category_id'] == $row['category_id'])
                                                                            echo '<option value="' . $row1['category_id'] . '" selected>' . $row1['category_name'] . '</option>';
                                                                        else
                                                                            echo '<option value="' . $row1['category_id'] . '">' . $row1['category_name'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <label for="price">Price (Rs.)</label>
                                                            <input type="number" class="form-control" name="price" id="price" value=<?php echo $row['price'] ?> required>
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <label for="price">Discount (%)</label>
                                                            <input type="number" class="form-control" name="discount" id="discount" value=<?php echo $row['discount'] ?> maxlength="100">
                                                        </div>
                                                    </div>

                                                    <div class="form-row d-flex mb-2">
                                                        <div class="form-group col-md-6 mb-4 mx-1">
                                                            <label for="size">Sizes available<br>(comma separated, if applicable)</label>
                                                            <input type="text" class="form-control" name="size" id="size" value="<?php echo $row['size_available'] ?> ">
                                                        </div>
                                                        <div class="form-group col-md-6 mb-4 mx-1">
                                                            <label for="size">Colours available<br>(comma separated, if applicable)</label>
                                                            <input type="text" class="form-control" name="colour" id="colour" value="<?php echo $row['colour_available'] ?> ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" name="update" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class='d-inline'>
                                    <?php echo '<input type="text" name="id" value="' . $row['product_id'] . '" hidden/>'; ?>
                                    <input type="submit" name="delete" class="card-btn btn btn-danger" value="Delete">
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

<?php include('./utilities/datatable.php') ?>

</html>