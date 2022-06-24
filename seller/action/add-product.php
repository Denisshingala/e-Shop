<?php
require('../../configuration/config.php');

if(isset($_POST['add-product-btn'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);
    $images = mysqli_real_escape_string($conn, $_FILES['product-images']);

    
}

?>