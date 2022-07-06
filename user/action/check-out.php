<?php

if (isset($_POST['place_order'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_no = $conn->real_escape_string($_POST['mobile_no']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $country = $conn->real_escape_string($_POST['country']);
    $pincode = $conn->real_escape_string($_POST['pincode']);
    if (isset($_POST['p_size']))
        $p_size = $conn->real_escape_string($_POST['p_size']);

    if (isset($POST['p_colour']))
        $p_colour = $conn->real_escape_string($_POST['p_colour']);

    $quantity = $conn->real_escape_string($_POST['quantity']);

    $sql = "INSERT INTO `orders`(`user_id`, `order_date`) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $_SESSION['user_id'], date("d-m-y"));
    if ($stmt->execute()) {
        $sql = "SELECT ";
    }
}
