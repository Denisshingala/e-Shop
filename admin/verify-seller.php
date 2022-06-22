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

        <div class="p-4">

            <table class="table table-bordered table-responsive table-striped">
                <thead class="text-center">
                    <tr style="background-color: rgb(95, 162, 240);">
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Company Address</th>
                        <th>GST No.</th>
                        <th>Bank Account No.</th>
                        <th>IFSC code</th>
                        <th>IFSC code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <span style="color:green; font-weight:bold; margin:5px;">Approve</span>
                            <span style="color:red; font-weight:bold; margin:5px;">Reject</span>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </main>

    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>