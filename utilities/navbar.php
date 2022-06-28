<?php
session_start();
?>

<div class="container-fluid">
    <div class="row align-items-center px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="index.php" class="text-decoration-none">
                <img src="./images/logo.png" alt="e-Shop" width="140" height="130">
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') {
        ?>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>

        <?php
        }
        ?>
    </div>
</div>

<hr>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0  bg-light" id="navbar-vertical" style="position:absolute; z-index:5; width:90%;">
                <div class="navbar-nav w-100 overflow-hidden">

                    <?php
                    $sql = "SELECT category_name FROM category";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $categories = "";
                        while ($row = $result->fetch_assoc()) {
                            $categories .= '<a href="#" class="nav-item nav-link">' . $row['category_name'] . '</a>';
                        }
                        echo $categories;
                    }
                    ?>
                </div>
            </nav>
        </div>
        <div class="col-md-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="detail.html" class="nav-item nav-link active">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <?php
                    if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') {
                        echo '<div class="navbar-nav ml-auto py-0">
                                <a href="./action/logout.php" class="nav-item nav-link">Logout</a>
                            </div>';
                    } else {
                        echo '<div class="navbar-nav ml-auto py-0">
                                <a href="login.php" class="nav-item nav-link">Login</a>
                                <a href="login.php" class="nav-item nav-link">Register</a>
                            </div>';
                    }
                    ?>

                </div>
            </nav>
        </div>
    </div>
</div>