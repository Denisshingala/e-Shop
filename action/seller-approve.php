<?php
if (isset($_POST['approve'])) {
    $id = mysqli_real_escape_string($conn, $_POST['seller_id']);

    $sql = "UPDATE 'seller' SET status='approve' where seller_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $success = "Successfully approved...";
    } else {
        $error = "Somthing went wrong...";
    }
}
if (isset($_POST['reject'])) {
    $id = mysqli_real_escape_string($conn, $_POST['seller_id']);

    $sql = "DELETE FROM 'seller' where seller_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        $success = "Successfully approved...";
    } else {
        $error = "Somthing went wrong...";
    }
}
