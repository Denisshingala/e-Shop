<?php
include('../configuration/config.php');

if (isset($_GET['pid']))
    $productID = $_GET['pid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-shop</title>
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

    <!-- Customized Bootstrap 4 Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <!-- Navbar Start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- Navbar End -->

    <hr>

    <div class="container-fluid px-xl-5 py-3">
        <?php
        $sql = "SELECT title FROM product WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        echo '<h4 class="my-4">Reviews for ' . $row['title'] . '</h4>'
        ?>

        <div id="review-section">
            <div class="row p-3">
                <div class="col-md-12">

                    <?php
                    $sql = "SELECT user.profile_image, user.name, reviews.review_date, reviews.description FROM reviews JOIN user ON user.user_id = reviews.user_id WHERE product_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $productID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        if ($row['profile_image'] === '')
                            $src = "https://bootdey.com/img/Content/avatar/avatar7.png";
                        else
                            $src = "../" . $row['profile_image'];

                        echo '<div class="media mb-4">
                                <img src="' . $src . '" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px; height: 45px; border-radius:50%;">
                                <div class="media-body">
                                    <h6>' . $row['name'] . '<small> - <i>' . $row['review_date'] . '</i></small></h6>
                                    <p>' . $row['description'] . '</p>
                                </div>
                            </div>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <?php include('./utilities/footer.php'); ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>