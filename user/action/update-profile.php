<?php
session_start();
include('../../configuration/config.php');

if(isset($_POST['update-profile-btn'])) {
    $email = $_SESSION['email'];

    $name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $DOB = $conn->real_escape_string($_POST['DOB']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $pincode = $conn->real_escape_string($_POST['pincode']);
    $country = $conn->real_escape_string($_POST['country']);

    $sql = "UPDATE user SET name=?, gender=?, dob=?, address=?, city=?, state=?, pincode=?, country=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $gender, $dob, $address, $city, $state, $pincode, $country, $email);
    if($stmt->execute()) {
        header("location: ../profile.php");
    }
    else {
        echo "not updated";
    }
}

?>