<?php
require('../configuration/config.php');
require('../action/auth.php');

if (isset($_SESSION['type']) && $_SESSION['type'] === 'user') {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $contactNo = $row['contact_number'];
        $gender = $row['gender'];
        $dob = $row['dob'];
        $address = $row['address'];
        $city = $row['city'];
        $pincode = $row['pincode'];
        $state = $row['state'];
        $country = $row['country'];
        $profileImage = $row['profile_image'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-shop | User</title>
    <?php include('utilities/header.php'); ?>
    <link rel="stylesheet" href="css/profile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #profile-update-input {
            position: relative;
            bottom: 0;
            top: 30px;
            right: 30px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        #profile-update-input::-webkit-file-upload-button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="row gutters">

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <form action="./action/update-profile.php" enctype="multipart/form-data" method="POST">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <?php
                                        if ($profileImage !== '')
                                            echo '<img src="../' . $profileImage . '" alt="Name">';
                                        else
                                            echo '<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Name">';
                                        ?>
                                        <label for="profile-update-input">
                                            <!-- <i class="fa-solid fa-pencil"></i> -->
                                            <input type="file" name="profile-update-input" id="profile-update-input" accept=".jpg, .jpeg, .png">
                                        </label>
                                    </div>
                                    <h5 class="user-name"><?php echo $name; ?></h5>
                                    <h6 class="user-email"><?php echo $email; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $contactNo; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="gender">Gender</label><br>
                                    <input type="radio" id="male" name="gender" <?php if ($gender == 'male') echo 'checked'; ?> value="male"> Male
                                    <input type="radio" id="female" name="gender" <?php if ($gender == 'female') echo 'checked'; ?> value="female"> Female
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="DOB">Date Of Birth <small>(MM/DD/YYYY)</small> </label>
                                    <input type="date" class="form-control" id="DOB" name="DOB" value="<?php echo $dob; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="Street">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $state; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $pincode; ?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="<?php echo $country; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <!-- <button type="submit" onclick="back()" id="back-btn" name="back-btn" class="btn btn-secondary">Back</button> -->
                                    <button type="submit" id="update-profile-btn" name="update-profile-btn" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

</body>

<!-- <script>
    function back() {
        history.go(-3);
    }
</script> -->

</html>