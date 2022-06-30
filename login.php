<?php

require('./configuration/config.php');
require('./action/auth.php');
require('./action/login.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Online Shopping</title>
</head>

<body>
    <!-- Alert start-->
    <?php if ($error) { ?>
        <center>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </center>
    <?php } else if ($success) { ?>
        <center>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </center>
    <?php } ?>
    <!-- Alert end-->

    <div class="container" id="container">

        <div class="form-container sign-up-container">

            <!-- type  -->
            <form id="type-form">
                <h3>Create Account as </h3>
                <select name="type" id="type" required>
                    <option value="seller" selected>Seller</option>
                    <option value="user">User</option>
                </select>
                <input type="button" class="btn btn-primary" onclick="next()" value="Next">
            </form>

            <!-- User Registration -->
            <form id="user" class="d-none" method="POST" onsubmit="return userValidation()" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <h3>User Registration</h3>
                <div class="content">
                    <input type="text" placeholder="Name" name="username" required />
                    <input type="email" placeholder="Email" name="useremail" required />
                    <input type="number" placeholder="Contact Number" name="usercontact" required />
                    <input type="date" placeholder="Birth date" name="userDOB" required />
                    <div class="radio w-100 my-2">
                        <label for="gender" style="margin-right: 15px;">Gender: </label>
                        <span class="mx-1 h6">
                            <input style="width:max-content" type="radio" name="usergender" value="male" required /> Male
                        </span>
                        <span class="mx-1 h6">
                            <input style="width:max-content" type="radio" name="usergender" value="female" required /> Female
                        </span>
                    </div>
                    <input type="text" placeholder="Address" name="useraddress" required />
                    <input type="text" placeholder="City" name="usercity" required />
                    <input type="number" placeholder="Pincode" name="userpincode" required />
                    <input type="text" placeholder="State" name="userstate" required />
                    <input type="text" placeholder="Country" name="usercountry" required />
                    <input type="password" placeholder="Password" id="user-pass" name="userpassword" required />
                    <input type="password" placeholder="Confirm password" id="user-confirmpass" name="userconfirmpassword" required />
                </div>
                <div class="btn-group w-100">
                    <input type="reset" onclick="backUser()" class="mx-1 btn btn-outline-secondary" value="Back" />
                    <input type="submit" class="mx-1 btn btn-primary" name="usersubmit" value="Sign Up" name="usersubmit" />
                </div>
            </form>

            <!-- Seller Registration -->
            <form id="seller" class="d-none" method="POST" onsubmit="return sellerValidation()" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <h3>Seller Registration</h3>
                <div class="content">
                    <input type="text" placeholder="Company name" name="companyName" required />
                    <input type="number" placeholder="GST number" name="GSTNumber" required />
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="text" placeholder="Contact number" name="contact" required />
                    <input type="text" placeholder="Account number" name="accountNumber" required />
                    <input type="text" placeholder="IFSC number" name="IFSCNumber" required />
                    <input type="text" placeholder="Company address" name="address" required />
                    <input type="password" placeholder="Password" id="seller-pass" name="password" required />
                    <input type="password" placeholder="Confirm password" id="seller-confirmpass" name="confirmpassword" required />
                </div>
                <div class="btn-group w-100">
                    <input type="reset" onclick="backSeller()" class="mx-1 btn btn-outline-secondary" value="Back" />
                    <input type="submit" class="mx-1 btn btn-primary" value="Sign Up" name="sellersubmit" />
                </div>
            </form>
        </div>


        <!-- Login -->
        <div class="form-container sign-in-container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <h1>Sign in</h1>
                <select name="type" required>
                    <option value="" disabled selected>- Select -</option>
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                    <option value="user">User</option>
                </select>
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />
                <a href="./forget-password.php">Forgot your password?</a>
                <input type="submit" class="btn btn-primary w-100" name="login" value="Sign In">
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