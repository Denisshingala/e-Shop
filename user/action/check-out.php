<?php

if (isset($_POST['place_order'])) {
    $length = sizeof($_SESSION['item']);
    $date = date("d-m-y");

    // set order
    $insert_order_stmt = $conn->prepare("INSERT INTO `orders`(`user_id`, `order_date`) VALUES (?,?)");
    $insert_order_stmt->bind_param("is", $_SESSION['user_id'], $date);

    //get order id
    $get_order_id_stmt = $conn->prepare("SELECT MAX(order_id) as order_id FROM `orders` WHERE user_id=? GROUP BY user_id");
    $get_order_id_stmt->bind_param("i", $_SESSION['user_id']);

    //set order Details
    $insert_order_details_stmt = $conn->prepare("INSERT INTO `order_details`(`order_id`, `product_id`, `size`, `colour`, `quantity`, `price`, `address`) VALUES (?,?,?,?,?,?,?)");
    $insert_order_details_stmt->bind_param("iissids", $id, $p_id, $p_size, $p_colour, $quantity, $price, $main_address);

    if ($insert_order_stmt->execute()) {
        $get_order_id_stmt->execute();
        $res = $get_order_id_stmt->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $id = $row['order_id'];
            $address = $conn->real_escape_string($_POST['address']);
            $city = $conn->real_escape_string($_POST['city']);
            $state = $conn->real_escape_string($_POST['state']);
            $country = $conn->real_escape_string($_POST['country']);
            $pincode = $conn->real_escape_string($_POST['pincode']);
            for ($i = 0; $i < $length; $i++) {
                $p_id = $_SESSION['item'][$i]['id'];
                if ($_SESSION['item'][$i]['size'] != '')
                    $p_size = $_SESSION['item'][$i]['size'];
                else
                    $p_size = "NULL";

                if ($_SESSION['item'][$i]['colour'] != '')
                    $p_colour = $_SESSION['item'][$i]['colour'];
                else
                    $p_colour = "NULL";

                $quantity = $_SESSION['item'][$i]['quantity'];
                $price = $_SESSION['item'][$i]['sellingPrice'];
                $main_address = $address . "," . $state . "," . $city . "," . $country . "-" . $pincode;

                if ($insert_order_details_stmt->execute()) {
                    $success = "Your Order has been placed!";
                } else {
                    $error = "During add product no $i!";
                }
            }
        }
    } else {
        $error = "Something went wrong!";
    }
}
