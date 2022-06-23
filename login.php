<?php

require('./configuration/config.php');

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
        echo "<script>alert('Data has been inserted...')</script>";
    } else {
        echo "<script>alert('Something went wrong...')</script>";
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
        echo "<script>alert('Data has been inserted...')</script>";
    } else {
        echo "<script>alert('Something went wrong...')</script>";
    }
}

// Login 
if (isset($_POST['login'])) {
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = 'SELECT * FROM ' . $type . ' WHERE email=?';
    // $sql = "SELECT * FROM " . $type . " where email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $row = $stmt->get_result()->fetch_assoc();
        if (isset($row['email'])) {
            if (password_verify($password, $row['password'])) {
                echo "<script>alert('You are logged in...')</script>";
            } else {
                echo "<script>alert('Your password is wrong...')</script>";
            }
        } else {
            echo "<script>alert('User not found...')</script>";
        }
    } else {
        echo "<script>alert('Something went wrong...')</script>";
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
    <link rel="stylesheet" href="css/login.css">
    <title>Online Shopping</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">

            <form id="type-form">
                <h3>Create Account as </h3>
                <select name="type" id="type" required>
                    <option value="seller" selected>Seller</option>
                    <option value="user">User</option>
                </select>
                <input type="button" class="btn btn-danger" onclick="next()" value="Next">
            </form>

            <!-- User Registration -->
            <form id="user" class="d-none" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <h3>User Registration</h3>
                <div class="content">
                    <input type="text" placeholder="Name" name="username" />
                    <input type="email" placeholder="Email" name="useremail" />
                    <input type="number" placeholder="Contact Number" name="usercontact" />
                    <input type="date" placeholder="Birth date" name="userDOB" />
                    <div class="radio w-100 my-2">
                        <label for="gender" style="margin-right: 15px;">Gender: </label>
                        <span class="mx-1 h6">
                            <input style="width:max-content" type="radio" name="usergender" value="male" /> Male
                        </span>
                        <span class="mx-1 h6">
                            <input style="width:max-content" type="radio" name="usergender" value="female" /> Female
                        </span>
                    </div>
                    <input type="text" placeholder="Address" name="useraddress" />
                    <input type="text" placeholder="City" name="usercity" />
                    <input type="number" placeholder="Pincode" name="userpincode" />
                    <input type="text" placeholder="State" name="userstate" />
                    <input type="text" placeholder="Country" name="usercountry" />
                    <input type="password" placeholder="Password" name="userpassword" />
                </div>
                <div class="btn-group w-100">
                    <input type="reset" onclick="backUser()" class="mx-1 btn btn-outline-secondary" value="Back" />
                    <input type="submit" class="mx-1 btn btn-danger" name="usersubmit" value="Sign Up" name="usersubmit" />
                </div>
            </form>

            <!-- Seller Registration -->
            <form id="seller" class="d-none" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <h3>Seller Registration</h3>
                <input type="text" placeholder="Company name" name="companyName" />
                <input type="number" placeholder="GST number" name="GSTNumber" />
                <input type="email" placeholder="Email" name="email" />
                <input type="text" placeholder="Contact number" name="contact">
                <input type="text" placeholder="Account number" name="accountNumber">
                <input type="text" placeholder="IFSC number" name="IFSCNumber">
                <input type="text" placeholder="Company address" name="address">
                <input type="password" placeholder="Password" name="password" />
                <div class="btn-group w-100">
                    <input type="reset" onclick="backSeller()" class="mx-1 btn btn-outline-secondary" value="Back" />
                    <input type="submit" class="mx-1 btn btn-danger" value="Sign Up" name="sellersubmit" />
                </div>
            </form>
        </div>

        <!-- Login -->
        <div class="form-container sign-in-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <h1>Sign in</h1>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
                <select name="type" id="type" required>
                    <option value="" disabled selected>- Select -</option>
                    <option value="seller">Seller</option>
                    <option value="user">User</option>
                </select>
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Password" name="password" />
                <a href="#">Forgot your password?</a>
                <input type="submit" class="btn btn-danger w-100" name="login" value="Sign In">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>

</html>