<?php

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);

    $sql = "UPDATE `product` SET `title`=?,`description`=?,`brand`=?,`price`=?,`discount`=?,`category_id`=?,`size_available`=?,`colour_available`=? WHERE `product_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiissi", $title, $description, $brand, $price, $discount, $category, $size, $colour, $id);
    if ($stmt->execute()) {
        $success = "Product has been updated...";
    } else {
        $error = "Oops! Something went wrong...";
    }
}
