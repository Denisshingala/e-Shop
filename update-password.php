<?php

require('./configuration/config.php');
require('./action/auth.php');
$flag = false;

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = openssl_decrypt($_GET['type'], $encryptionAlgo, $encryptionKey, 0, $initVector);
    $email = openssl_decrypt($_GET['id'], $encryptionAlgo, $encryptionKey, 0, $initVector);

    if ($type == "seller" || $type == "user") {
        $sql = "SELECT * FROM " . $type . " WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $flag = true;
        }
    }
} else {
    header("location:/e-shop");
}

if (isset($_POST['submit'])) {

    if ($type == "seller" || $type == "user") {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE " . $_POST['type'] . " SET password=? where email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hash_password, $_POST['email']);

        if ($stmt->execute()) {
            // $result = $stmt->get_result();
            if ($stmt->affected_rows > 0) {
                $success = "Password has been changed...";
                header("location: /e-shop/login.php");
            } else {
                $error = "Error! Invalid Token...";
            }
        } else {
            $error = "Error! Invalid Token...";
        }
    } else {
        $error = "Error! Invalid Token...";
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

    if ($flag) { ?>

        <div class="container-fluid">
            <img src="./images/logo.png" alt="logo" width="150" height="150" class="img-fluid">
            <hr class="mt-0 mb-4" />
            <h2 class="fw-bold">Forget Password</h2>
            <form class="p-4" id="form2" method="POST" onsubmit="return passwordverify()">
                <input type="text" name="type" value="<?php echo $type ?>" hidden>
                <input type="text" name="email" value="<?php echo $email ?>" hidden>
                <input type="password" name="password" id="pass" class="form-control w-100 fw-light" placeholder="Enter your new password" /> <br />
                <input type="text" id="repass" class="form-control w-100 fw-light" placeholder="Confirm password" />
                <input type="submit" name="submit" class="btn btn-danger w-100 my-3" />
            </form>
        </div>
    <?php } else { ?>
        <div class="container-fluid error-container">
            <img src="./images/error.gif" alt="error" width="300" height="300" class="img-fluid">
            <p><strong>Oops!</strong>&nbsp; Invalid Token</p>
        </div>
    <?php } ?>
    <script>
        const passwordverify = () => {
            let pass = document.getElementById('pass').value;
            let repass = document.getElementById('repass').value;

            if (pass !== repass) {
                alert('Password and re-password should be same!!!');
                return false;
            }
        }
    </script>
</body>

</html>