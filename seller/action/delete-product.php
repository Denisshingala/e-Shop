<?php

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM `product` WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success = "Product successfully deleted";
    } else {
        $error = "Oops! Product can't delete!";
    }
}
