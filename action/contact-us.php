<?php
$error="";
$success="";
// user sign up 
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);


    $sql = "INSERT INTO `contactus`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $msg);

    if ($stmt->execute()) {
        // echo "<script>alert('Data has been inserted...')</script>";
        $success = "Congratulation! Account has been created...";
    } else {
        // echo "<script>alert('Something went wrong...')</script>";
        $error = "Oops! Something went wrong...";
    }
 }
