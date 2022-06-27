<?php

require('./configuration/config.php');

if (isset($_POST['submit1'])) {
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "select * from " . $type . " where email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['email']);
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows() > 0) {
            $type = openssl_encrypt($_POST['type'], $encryptionAlgo, $encryptionKey, 0, $initVector);
            $email = openssl_encrypt($_POST['email'], $encryptionAlgo, $encryptionKey, 0, $initVector);

            $to = $_POST['email'];
            $subject = "Update password";

            $message = "<html>
                <head>
                <title>HTML email</title>
                </head>
                <body>
                <center>
                    <a href='http://localhost/e-shop/update-password.php?id=$email&type=$type'><img src=`https://i.postimg.cc/Y2d2DZq7/email.png` /></a>
                </center>
                </body>
            </html>";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: ssiphostel2425@gmail.com';

            if (mail($to, $subject, $message, $headers)) {
                $success = "Mail has been sent on your email id!";
            } else {
                $error = "Oops! Mail server is not give response...";
            }
        } else {
            $error = "Oops! user not found...";
        }
    } else {
        $error = "Something went wrong...";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/forget-update-passoword.css">
    <title>Online Shopping</title>
</head>

<body>
    <?php
    if ($error) {
        echo "<div class='mt-3 alert alert-danger alert-dismissible w-25 fade show text-center' role='alert'>
            $error
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    } else if ($success) {
        echo "<div class='mt-3 alert alert-success alert-dismissible w-25 fade show text-center' role='alert'>
            $success
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
    ?>
    <div class="container-fluid">
        <img src="./images/logo.png" alt="logo" width="150" height="150" class="img-fluid">
        <hr class="mt-0 mb-4" />
        <h2 class="fw-bold">Forget Password</h2>
        <form class="p-4" id="form1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <select name="type" class="form-control" id="type">
                <option value="" disabled selected>- Type -</option>
                <option value="seller">Seller</option>
                <option value="user">User</option>
            </select><br>
            <input type="text" name="email" class="form-control w-100 fw-light" id="" placeholder="Enter your email" />
            <input type="submit" name="submit1" class="btn btn-danger w-100 my-3" />
        </form>
        <!-- <form class="p-4 d-none" id="form2" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return passwordverify()">
            <input type="text" name="type" value="<?php echo $type ?>" hidden>
            <input type="text" name="email" value="<?php echo $email ?>" hidden>
            <input type="password" name="password" id="pass" class="form-control w-100 fw-light" placeholder="Enter your password" /> <br />
            <input type="text" id="repass" class="form-control w-100 fw-light" placeholder="Confirm password" />
            <input type="submit" name="submit2" class="btn btn-danger w-100 my-3" />
        </form> -->
    </div>
</body>

</html>