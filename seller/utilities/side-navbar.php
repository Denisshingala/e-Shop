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
            <a href="add-product.php" class="nav-link text-white <?php echo ($filename == 'add-product.php') ? 'active' : ''; ?>">
                Add Products
            </a>
        </li>
        <li>
            <a href="view-products.php" class="nav-link text-white <?php echo ($filename == 'view-products.php') ? 'active' : ''; ?>">
                View Your Products
            </a>
        </li>
        <li>
            <a href="edit-product-details.php" class="nav-link text-white <?php echo ($filename == 'edit-product-details.php') ? 'active' : ''; ?>">
                Edit Product Details
            </a>
        </li>
        <li>
            <a href="delete-product.php" class="nav-link text-white <?php echo ($filename == 'delete-product.php') ? 'active' : ''; ?>">
                Delete Product
            </a>
        </li>
        <li>
            <a href="products-sold-details.php" class="nav-link text-white <?php echo ($filename == 'products-sold-details.php') ? 'active' : ''; ?>">
                Products Sold details
            </a>
        </li>
        <li>
            <a href="order-details.php" class="nav-link text-white <?php echo ($filename == 'order-details.php') ? 'active' : ''; ?>">
                Order details
            </a>
        </li>
        <li>
            <a href="payment-history.php" class="nav-link text-white <?php echo ($filename == 'payment-history.php') ? 'active' : ''; ?>">
                Payment History
            </a>
        </li>
    </ul>

</div>