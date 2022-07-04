<?php

if (isset($_POST['block_btn'])) {
    $id = $conn->real_escape_string($_POST['block_btn']);

    $sql = "UPDATE `seller` SET status='block' WHERE seller_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $success = "Success! Seller has been block!";
        } else {
            $error = "Oops! Seller is not found!";
        }
    } else {
        $error = "Oops! Somthing went wrong!";
    }
}

if (isset($_POST['unblock_btn'])) {
    $id = $conn->real_escape_string($_POST['unblock_btn']);

    $sql = "UPDATE `seller` SET status='approve' WHERE seller_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $success = "Success! Seller has been unblock!";
        } else {
            $error = "Oops! Seller is not found!";
        }
    } else {
        $error = "Oops! Somthing went wrong!";
    }
}

if (isset($_POST['delete_btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete_btn']);
    echo $id;
    $sql = "DELETE FROM seller where seller_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success = "Success! Seller has been removed!";
    } else {
        $error = "Somthing went wrong...";
    }
}
