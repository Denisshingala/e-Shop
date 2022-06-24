<?php
<<<<<<< HEAD
=======

>>>>>>> 4d8445c301bdae2746182d60b98fe06a5d3925f6
$success = "";
$error = "";

// user sign up 
if (isset($_POST['usersubmit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['useremail']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['usercontact']);
    $DOB = mysqli_real_escape_string($conn, $_POST['userDOB']);
    $gender = mysqli_real_escape_string($conn, $_POST['usergender']);
    $address = mysqli_real_escape_string($conn, $_POST['useraddress']);
    $city = mysqli_real_escape_string($conn, $_POST['usercity']);
    $pincode = mysqli_real_escape_string($conn, $_POST['userpincode']);
    $state = mysqli_real_escape_string($conn, $_POST['userstate']);
    $country = mysqli_real_escape_string($conn, $_POST['usercountry']);
    $password = mysqli_real_escape_string($conn, $_POST['userpassword']);
    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `user`(`name`, `email`, `password`, `contact_number`, `gender`, `dob`, `address`, `city`, `pincode`, `state`, `country`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissssiss", $name, $email, $newPassword, $contact_number, $gender, $DOB, $address, $city, $pincode, $state, $country);

    if ($stmt->execute()) {
        // echo "<script>alert('Data has been inserted...')</script>";
        $success = "Congratulation! Account has been created...";
    } else {
        // echo "<script>alert('Something went wrong...')</script>";
        $error = "Oops! Something went wrong...";
    }
}

// seller sign up 
if (isset($_POST['sellersubmit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['companyName']);
    $GST = mysqli_real_escape_string($conn, $_POST['GSTNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $accountNumber = mysqli_real_escape_string($conn, $_POST['accountNumber']);
    $IFSCNumber = mysqli_real_escape_string($conn, $_POST['IFSCNumber']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `seller`(`company_name`, `email`, `password`, `contact_number`, `gst_number`, `account_number`, `IFSC_code`, `company_address`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $name, $email, $newPassword, $contact, $GST, $accountNumber, $IFSCNumber, $address);

    if ($stmt->execute()) {
        // echo "<script>alert('Data has been inserted...')</script>";
        $success = "Congratulation! Account has been created...";
    } else {
        // echo "<script>alert('Something went wrong...')</script>";
        $error = "Oops! Something went wrong...";
    }
}

// Login 
if (isset($_POST['login'])) {
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = 'SELECT * FROM ' . $type . ' WHERE email=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (isset($row['email'])) {

            if (password_verify($password, $row['password'])) {

                // echo "<script>alert('You are logged in...')</script>";

                $_SESSION['type'] = $type;
                // TODO : PUT ALL IN ELSE IF
                if ($type === "seller") {

                    if ($row['status'] !== 'pending') {
                        $_SESSION['email'] = $row['email'];
                        $success = "Congratulation! You are logged in...";
                        header("location: ./seller/dashboard.php");
                    } else {
                        $success = "Oops! Your approval is on pending...";
                    }
                } else {

                    $_SESSION['email'] = $row['email'];
                    $success = "Congratulation! You are logged in...";

                    $type === "user" ? header("/login.php") : header("location:./admin/dashboard.php");
                }
            } else {
                // echo "<script>alert('Your password is wrong...')</script>";
                $error = "Oops! Your password is wrong...";
            }
        } else {
            // echo "<script>alert('User not found...')</script>";
            $error = "Oops! User not found..";
        }
    } else {
        // echo "<script>alert('Something went wrong...')</script>";
        $error = "Oops! Something went wrong...";
    }
}
