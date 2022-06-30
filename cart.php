<?php
include('./configuration/config.php');
include('./action/auth.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>e-Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap 4 Stylesheet -->
    <link href="style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Error-Success message Start -->
    <?php include('utilities/error-success.php') ?>
    <!-- Error-Success message End -->

    <!-- navbar start -->
    <?php include('./utilities/navbar.php'); ?>
    <!-- navbar end -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $sql = "SELECT * FROM `cart` as c JOIN `product` as p ON p.product_id=c.product_id WHERE c.user_id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['product_id'];
                                $price = $row['price'] - ($row['price'] * $row['discount']) / 100;
                        ?>
                                <tr id="tr-<?php echo $id ?>">
                                    <td class="align-middle"><?php echo $row['title'] ?></td>
                                    <td class="align-middle"><?php echo $price ?></td>
                                    <td class="align-middle" id="add-remove-<?php echo $id ?>">
                                        <div class="input-group quantity m-auto" style="width: 120px;">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-minus" onclick="decQuantity(<?php echo $id ?>)">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control bg-secondary text-center h-100" value="<?php echo $row['quantity'] ?>" id="quantity-<?php echo $id ?>" name="p_quantity" min="1" required>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-plus" onclick="incQuantity(<?php echo $id ?>)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?php echo $price * $row['quantity'] ?></td>

                                    <?php
                                    $sql1 = "SELECT size_available,colour_available FROM `product` WHERE product_id=?";
                                    $stmt1 = $conn->prepare($sql1);
                                    $stmt1->bind_param("i", $row['product_id']);
                                    $stmt1->execute();
                                    $res = $stmt1->get_result();
                                    $row1 = $res->fetch_assoc();
                                    echo '<td class="align-middle">';
                                    if ($row1['size_available'] == NULL) {
                                        echo '<select disabled>
                                                    <option value="" selected disabled>- Select -</option>
                                                </select>';
                                    } else {
                                        $sizes = explode(',', $row1['size_available']);
                                        echo '<select name="size" id="size-' . $id . '" class="w-100" required onchange="setSize(' . $id . ')">';
                                        if ($row['size'] == NULL)
                                            echo '<option value="" selected disabled>- Select -</option>';
                                        foreach ($sizes as $size) {
                                            if ($row['size'] == $size)
                                                echo '<option class="text-center" value="' . $size . '" selected>' . $size . '</option>';
                                            else
                                                echo '<option class="text-center" value="' . $size . '">' . $size . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                    echo '</td>';
                                    echo '<td class="align-middle">';
                                    if ($row1['colour_available'] == NULL) {
                                        echo '<select disabled>
                                                    <option value="" selected disabled>- Select -</option>
                                                </select>';
                                    } else {
                                        $colours = explode(',', $row1['colour_available']);
                                        echo '<select name="colour" id="colour-' . $id . '" class="w-100" required onchange="setColour(' . $id . ')">';
                                        if ($row['colour'] == NULL)
                                            echo '<option value="" selected disabled>- Select -</option>';
                                        foreach ($colours as $colour) {
                                            if ($row['colour'] == $colour)
                                                echo '<option class="text-center" value="' . $colour . '" selected>' . $colour . '</option>';
                                            else
                                                echo '<option class="text-center" value="' . $colour . '">' . $colour . '</option>';
                                        }

                                        echo '</select>';
                                    }
                                    echo '</td>';
                                    $stmt1->close();
                                    ?>
                                    <td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7'>No data found!</td></tr>";
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <!-- <div class="col-md-6 px-xl-0"> -->
            <p class="text-center text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">e-shop</a>. All Rights Reserved. Designed by
                <a class="text-dark font-weight-semi-bold" href="#">VGEC student</a>
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript start -->
    <script>
        const incQuantity = (id) => {
            let quantity_value = document.getElementById('quantity-' + id).value;
            $.ajax({
                url: "./action/cart-action.php",
                method: "POST",
                data: {
                    add_item_id: id,
                    item_quantity: quantity_value
                },
                success: (content) => {
                    $("#add-remove-" + id).html(content);
                }
            })
        }
        const decQuantity = (id) => {
            let quantity_value = document.getElementById('quantity-' + id).value;
            if (quantity_value > 1) {
                $.ajax({
                    url: "./action/cart-action.php",
                    method: "POST",
                    data: {
                        remove_item_id: id,
                        item_quantity: quantity_value
                    },
                    success: (content) => {
                        $("#add-remove-" + id).html(content);
                    }
                })
            }
        }
        const setColour = (id) => {
            let colour = document.getElementById('colour-' + id).value;
            $.ajax({
                url: "./action/cart-action.php",
                method: "POST",
                data: {
                    item_id: id,
                    colour: colour
                }
            })
        }

        const setSize = (id) => {
            let size = document.getElementById('size-' + id).value;
            $.ajax({
                url: "./action/cart-action.php",
                method: "POST",
                data: {
                    item_id: id,
                    size: size
                }
            })
        }
        const verifyItem = (id) => {
            let quantity = document.getElementById(id);
            if (quantity.value <= 0) {
                alert("Error ! Item quantity should be more than 0");
                return false;
            }
        }
    </script>
    <!-- JavaScript end -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>