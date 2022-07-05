<?php
session_start();
include('../../configuration/config.php');

if (isset($_POST['update-profile-btn'])) {
    $email = $_SESSION['email'];

    $companyName = $conn->real_escape_string($_POST['company-name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $gstNo = $conn->real_escape_string($_POST['gst-no']);
    $accountNo = $conn->real_escape_string($_POST['account-no']);
    $companyAddress = $conn->real_escape_string($_POST['company-address']);
    $IFSC_code = $conn->real_escape_string($_POST['IFSC-code']);

    $sql = "UPDATE seller SET company_name=?, contact_number=?, gst_number=?, account_number=?, IFSC_code=?, company_address=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $companyName, $phone, $gstNo, $accountNo, $IFSC_code, $companyAddress, $email);
    if ($stmt->execute()) {
        header("location: ../profile.php");
    } else {
        echo "not updated";
    }
}
