<?php
require('../configuration/config.php');
require('./action/auth.php');
require('./action/seller-approve.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>e-Shop | Admin</title>

    <?php include('utilities/header.php') ?>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('utilities/navbar.php') ?>

    <main class="d-flex">
        <?php include('utilities/side-navbar.php') ?>
        <div class="p-4 main-body">
            <?php include('utilities/alert.php'); ?>
            <table class="table table-bordered table-responsive table-striped">
                <thead class="text-center">
                    <tr style="background-color: rgb(95, 162, 240);">
                        <th>Id</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Company Address</th>
                        <th>GST No.</th>
                        <th>Bank Account No.</th>
                        <th>IFSC code</th>
                        <th>Approve</th>
                        <th>Reject</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    $sql = "select * from seller where status='pending'";
                    $stmt = $conn->prepare($sql);
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row['seller_id'] . "</td>
                            <td>" . $row['company_name'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['contact_number'] . "</td>
                            <td>" . $row['company_address'] . "</td>
                            <td>" . $row['gst_number'] . "</td>
                            <td>" . $row['account_number'] . "</td>
                            <td>" . $row['IFSC_code'] . "</td>";
                    ?>
                            <td>
                                <span style='color:green; font-weight:bold; text-decoration:underline; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#approve<?php echo $row['seller_id'] ?>'>Approve</span>
                                <!-- Modal -->
                                <div class='modal fade' id='approve<?php echo $row['seller_id'] ?>' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='staticBackdropLabel'>Modal title</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                Are you sure, you want to approve <strong><?php echo $row['company_name'] ?></strong>?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                <?php
                                                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
                                                    <input type='text' name='seller_id' value='" . $row['seller_id'] . "' hidden/>
                                                    <input type='submit' name='approve' class='btn btn-primary' value='Okay' />
                                                </form>"; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style='color:red; font-weight:bold; text-decoration:underline; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#reject<?php echo $row['seller_id'] ?>'>Reject</span>
                                <!-- Modal -->
                                <div class='modal fade' id='reject<?php echo $row['seller_id'] ?>' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='staticBackdropLabel'>Modal title</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                Are you sure, you want to reject <strong><?php echo $row['company_name'] ?></strong>?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                <?php
                                                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
                                                    <input type='text' name='seller_id' value='" . $row['seller_id'] . "' hidden/>
                                                    <input type='submit' name='reject' class='btn btn-primary' value='Okay' />
                                                </form>"; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>
                    <?php }
                    } else {
                        $error = "Something went wrong...";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </main>

</body>

</html>