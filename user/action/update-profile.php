<?php
session_start();
include('../../configuration/config.php');

if (isset($_POST['update-profile-btn'])) {
    $email = $_SESSION['email'];

    $name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['DOB']);
    $address = $conn->real_escape_string($_POST['address']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $pincode = $conn->real_escape_string($_POST['pincode']);
    $country = $conn->real_escape_string($_POST['country']);

    if (isset($_FILES['profile-update-input'])) {

        $inputProfileImage = $_FILES['profile-update-input'];
        $profileImageName = $inputProfileImage['name'];
        $profileImageTmpName = $inputProfileImage['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $profileImageName);
        $imageExtension = strtolower(end($imageExtension));

        if (in_array($imageExtension, $validImageExtensions)) {
            $sql = "SELECT profile_image FROM user WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $dbProfileImageName = explode('_', $row['profile_image']);
            echo $dbProfileImageName[1];

            if ($profileImageName !== $dbProfileImageName[1]) {
                // different image chosen
                $imageName = time() . "_" . $profileImageName;
                $path = dirname(dirname(__DIR__)) . "\upload\\" . $imageName;
                if (move_uploaded_file($profileImageTmpName, $path)) {
                    unlink(dirname(dirname(__DIR__)) . '/' . $row['profile_image']);
                    $uploadPath = "upload/" . $imageName;
                }


                $sql = "UPDATE user SET profile_image=? WHERE email=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $uploadPath, $email);
                if ($stmt->execute()) {
                    echo " image updated";
                } else {
                    echo "error in image updation";
                }
            } else {
                echo "Same image already exist";
            }
        } else {
            echo "Not valid image extension";
        }
    } else {
        echo "file not set";
    }


    $sql = "UPDATE user SET name=?, gender=?, dob=?, address=?, city=?, state=?, pincode=?, country=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $gender, $dob, $address, $city, $state, $pincode, $country, $email);
    if ($stmt->execute()) {
        header("location: /e-shop/");
    } else {
        echo "not updated";
    }
}
