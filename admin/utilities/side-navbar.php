<?php
$filename = basename($_SERVER['REQUEST_URI']);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:535px;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white <?php echo ($filename == 'dashboard.php') ? 'active' : ''; ?>" aria-current="page">
                Dashboard
            </a>
        </li>
        <li>
            <a href="verify-seller.php" class="nav-link text-white <?php echo ($filename == 'verify-seller.php') ? 'active' : ''; ?>">
                Verify Seller
            </a>
        </li>
        <li>
            <a href="categories.php" class="nav-link text-white <?php echo ($filename == 'categories.php') ? 'active' : ''; ?>">
                Categories
            </a>
        </li>
        <li>
            <a href="seller-details.php" class="nav-link text-white <?php echo ($filename == 'seller-details.php') ? 'active' : ''; ?>">
                Seller Details
            </a>
        </li>
    </ul>

</div>