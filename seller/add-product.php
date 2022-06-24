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

        <div style="width:100%;">

            <h4 class="p-3 pl-5 text-white" style="background-color:rgb(67, 144, 233);">Add Product</h4>

            <form action="./action/add-product.php" method="POST" class="p-5" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="title">Product Title</label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>

                <div class="form-group mb-4">
                    <label for="description">Product Description</label>
                    <br><textarea name="description" id="description" cols="135" rows="4" class="form-control" style="resize: none;"></textarea>
                </div>

                <div class="mb-4">
                    <label for="images" class="form-label">Product Images</label>
                    <input type="file" class="form-control" name="product-images[]" id="product-images" multiple required>
                </div>

                <div class="form-row mb-4">
                    <div class="form-group col-md-3">
                        <label for="brand">Brand Name</label>
                        <input type="text" class="form-control" name="brand" id="brand">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control" required>
                            <option selected disabled>Choose...</option>
                            <?php
                            include('../configuration/config.php');

                            $sql = "SELECT * FROM category";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $option;
                                while ($row = $result->fetch_assoc()) {
                                    $option .= '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                }
                                echo $option;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="price">Price (Rs.)</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="price">Discount (%)</label>
                        <input type="number" class="form-control" name="discount" id="discount" maxlength="100">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="form-group col-md-6 mb-4">
                        <label for="size">Sizes available (comma separated, if applicable)</label>
                        <input type="text" class="form-control" name="size" id="size">
                    </div>
                    <div class="form-group col-md-6 mb-4">
                        <label for="size">Colours available (comma separated, if applicable)</label>
                        <input type="text" class="form-control" name="colour" id="colour">
                    </div>
                </div>

                <button type="submit" id="add-product-btn" name="add-product-btn" class="btn btn-primary">Add product</button>
            </form>

        </div>

    </main>

    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>