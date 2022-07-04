<?php
$sellerID = $_SESSION['seller_id'];

if(isset($_POST['add-product-btn'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $categoryID = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);

    if($size == '') 
        $size = NULL;
    if($colour == '') 
        $colour = NULL;

    $images = $_FILES['product-images'];
    $filename = $images['name'];
    $file_tmp_name = $images['tmp_name'];
    $count = count($filename);
    $array = array();

    echo "<br>";
    for ($i = 0; $i < $count; $i++) {
        $imageName = time() . "_" . $filename[$i];
        $path = dirname(dirname(__DIR__)) . "\upload\\" . $imageName;
        move_uploaded_file($file_tmp_name[$i], $path);
        $uploadPath = "upload/" . $imageName;
        array_push($array, $uploadPath);
    }
    $string = implode(",", $array);

    $sql = "INSERT INTO product (title, description, brand, price, discount, category_id, seller_id, image, size_available, colour_available) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssddiisss", $title, $description, $brand, $price, $discount, $categoryID, $sellerID, $string, $size, $colour);
    if ($stmt->execute()) {
        $success = "Product added";
    } else {
        $error = "Unable to add product due to technical issue";
    }
}

?>