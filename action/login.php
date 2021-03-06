<?php

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

    $sql = "SELECT * FROM `seller` WHERE account_number=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $accountNumber, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {

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
    } else {
        $error = "Oops! Account already registered...";
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

            // Passoword verification
            if (password_verify($password, $row['password'])) {

                // Check whether account is block or not
                if ($row['status'] !== 'block') {

                    // Set session
                    $_SESSION['type'] = $type;

                    if ($type === "seller") {

                        if ($row['status'] !== 'pending') {
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['seller_id'] = $row['seller_id'];
                            $success = "Congratulation! You are logged in!";
                            header("location: ./seller/dashboard.php");
                        } else {
                            $success = "Oops! Your approval is on pending!";
                        }
                    } else {

                        $_SESSION['email'] = $row['email'];
                        $success = "Congratulation! You are logged in!";

                        if ($type === "user") {
                            $_SESSION['user_id'] = $row['user_id'];
                            header("location: ./index.php");
                        } else {
                            header("location:./admin/dashboard.php");
                        }
                    }
                } else {
                    $error = "Your account is blocked! Please contact to system administrator";
                }
            } else {
                $error = "Oops! Your password is wrong";
            }
        } else {
            $error = "Oops! User not found";
        }
    } else {
        $error = "Oops! Something went wrong";
    }
}
