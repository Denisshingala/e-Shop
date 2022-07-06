<!-- This will contain category wise products -->
<?php
include('../configuration/config.php');
include('../action/auth.php');
include('./action/add-cart.php');
$categoryID = $_GET['cid'];
$pageNo = $_GET['page_no'];
$limitPerPage = 2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <?php include('./utilities/error-success.php'); ?>
    <!-- Navbar Start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- Navbar End -->

    <hr>

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">

                <!-- Hidden field to get categoryID in JS  -->
                <input type="hidden" name="category_id" id="category-id" value="<?php echo $categoryID; ?>">
                <input type="hidden" name="page_no" id="page-no" value="<?php echo $pageNo; ?>">

                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4" id="price-range">
                    <h5 class="font-weight-semi-bold mb-4">Price Range (&#x20b9;)</h5>
                    <form>

                        <?php
                        include('action/calculateRange.php');

                        $sql = "SELECT min(price) as minprice, max(price) as maxprice FROM product WHERE category_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $max = $row['maxprice'];
                            $min = $row['minprice'];

                            $arr = calculateRange($min, $max);

                            for ($i = 0; $i < 4; $i++) {
                                $minValue = $arr[$i];
                                $maxValue = $arr[$i + 1];
                                $range = $minValue . ' - ' . $maxValue;
                        ?>
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="price-range" class="custom-control-input price-range" id="price-<?php echo $i + 1; ?>" value="<?php echo $range; ?>">

                                    <label class="custom-control-label" for="price-<?php echo $i + 1; ?>"><?php echo $range; ?></label>
                                    <span class="badge border font-weight-normal">150</span>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </form>
                </div>
                <!-- Price End -->

                <!-- Brand filter Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Brand</h5>
                    <form>

                        <?php
                        $sql = "SELECT DISTINCT(brand) FROM product WHERE category_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $categoryID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {

                                echo '<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                    <input type="checkbox" name="brand" class="custom-control-input brand" id="brand-' . $i . '" value="' . $row['brand'] . '">

                                    <label class="custom-control-label" for="brand-' . $i . '">' . $row['brand'] . '</label>
                                    <span class="badge border font-weight-normal">150</span>
                                </div>';

                                $i++;
                            }
                        }
                        ?>

                    </form>
                </div>
                <!-- Brand filter End -->
            </div>

            <!-- Shop Sidebar End -->

            <div class="col-lg-9 col-md-12" id="show-products-category-wise">
            </div>


        </div>
    </div>
    <!-- Shop End -->


    <!-- Footer Start -->
    <?php include('./utilities/footer.php'); ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

</body>
<script src="js/script.js"></script>
</html>