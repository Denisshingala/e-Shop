<?php
$filename = basename($_SERVER['REQUEST_URI']);

if ($filename == 'index.php' || $filename == 'e-shop')
    $path = '';
else
    $path = '../';
?>

<div class="container-fluid">
    <div class="row align-items-center px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="index.php" class="text-decoration-none">
                <?php
                if ($filename == 'index.php' || $filename == 'e-shop')
                    echo '<img src="./images/logo.png" alt="e-Shop" width="140" height="130">';
                else
                    echo '<img src="../images/logo.png" alt="e-Shop" width="140" height="130">';
                ?>
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
                <a href="/e-shop/user/cart.php" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">
                        <?php
                        $sql = "SELECT * from `cart` WHERE user_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo $result->num_rows;
                        ?>
                    </span>
                </a>
                <a href="/e-shop/user/profile.php" class="mx-4">
                    <?php
                    $sql = "SELECT profile_image from user WHERE user_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    if ($row['profile_image'] !== '')
                        echo '<img src="' . $path . $row['profile_image'] . '" alt="Profile picture" width="50" height="50" style="border-radius:50%;">';
                    else
                        echo '<img src="' . $path . 'https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile picture" width="50" height="50" style="border-radius:50%; border:1px solid rgba(0,0,0,0.3); padding:2px;">';

                    ?>

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
                    $sql = "SELECT * FROM category";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $categories = "";
                        while ($row = $result->fetch_assoc()) {
                            $categories .= '<a href="'.$path.'user/products.php?cid='.$row['category_id'].'&page_no=1" class="nav-item nav-link">' . $row['category_name'] . '</a>';
                        }
                        echo $categories;
                    }
                    ?>
                </div>
            </nav>
        </div>
        <div class="col-md-9 px-0">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0" style="padding:0; margin:0;">
                <!-- <img src="/e-shop/images/logo.png" alt="e-shop" width="100" height="100"> -->
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">

                        <a href="<?php echo $path; ?>index.php" class="nav-item nav-link">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="detail.html" class="nav-item nav-link active">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <?php
                        if ($filename == 'index.php' || $filename == 'e-shop')
                            echo '<a href="user/contact-us.php" class="nav-item nav-link">Contact</a>';
                        else
                            echo '<a href="contact-us.php" class="nav-item nav-link">Contact</a>';
                        ?>

                        <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') {
                            echo '<a href="order-history.html" class="nav-item nav-link">Order history</a>';
                        } ?>
                    </div>
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') { ?>
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                            if ($filename == 'index.php')
                                echo '<a href="'.$path.'action/logout.php" class="nav-item nav-link">Logout</a>';
                            else
                                echo '<a href="'.$path.'action/logout.php" class="nav-item nav-link">Logout</a>';
                            ?>

                        </div>
                    <?php } else { ?>
                        <div class="navbar-nav ml-auto py-0">

                            <a href="<?php echo $path; ?>login.php" class="nav-item nav-link">Login/Register</a>
                        </div>
                    <?php } ?>
                </div>
            </nav>
        </div>
    </div>
</div>