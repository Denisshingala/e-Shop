<?php

if (isset($_POST['add_cart'])) {
    $id = mysqli_real_escape_string($conn, $_POST['p_id']);

    $sql = "SELECT * FROM `cart` WHERE product_id=? AND user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();

    if ($res->num_rows <= 0) {
        $quantity = mysqli_real_escape_string($conn, $_POST['p_quantity']);
        if (isset($_POST['p_colour']))
            $colour = mysqli_real_escape_string($conn, $_POST['p_colour']);
        else
            $colour = NULL;

        if (isset($_POST['p_size']))
            $size = mysqli_real_escape_string($conn, $_POST['p_size']);
        else
            $size = NULL;
            
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO `cart` (`user_id`,`product_id`,`quantity`,`size`,`colour`) VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiis", $user_id, $id, $quantity, $size, $colour);
        if ($stmt->execute()) {
            $success = "Added in your cart";
        }
        $stmt->close();
    } else {
        $error = "Item already exists in cart...";
    }
}
