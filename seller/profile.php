<?php
require('../configuration/config.php');
require('./action/auth.php');

if (isset($_SESSION['type']) && $_SESSION['type'] === 'seller') {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM seller WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $companyName = $row['company_name'];
        $contactNo = $row['contact_number'];
        $gstNo = $row['gst_number'];
        $accountNo = $row['account_number'];
        $IFSC_code = $row['IFSC_code'];
        $companyAddress = $row['company_address'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-shop | Seller</title>
    <?php include('utilities/header.php'); ?>
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="container">

        <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="./action/update-profile.php" enctype="multipart/form-data" method="POST">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-4 text-primary">Organization Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="company-name">Company Name</label>
                                        <input type="text" class="form-control" id="company-name" name="company-name" value="<?php echo $companyName; ?>">
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
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $contactNo; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="gst-no">GST Number</label>
                                        <input type="text" class="form-control" id="gst-no" name="gst-no" value="<?php echo $gstNo; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="account-no">Account Number</label>
                                        <input type="text" class="form-control" id="account-no" name="account-no" value="<?php echo $accountNo; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="IFSC-code">IFSC Code</label>
                                        <input type="text" class="form-control" id="IFSC-code" name="IFSC-code" value="<?php echo $IFSC_code; ?>">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="company-address">Company Address</label>
                                        <input type="text" class="form-control" id="company-address" name="company-address" value="<?php echo $companyAddress; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
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

</html>