<?php
require('../../configuration/config.php');

if(isset($_POST['add-product-btn'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $colour = mysqli_real_escape_string($conn, $_POST['colour']);

    $images = mysqli_real_escape_string($conn, $_FILES['product-images']);

    print_r($images);
    $filename = $images['name'];
    $file_tmp_name = $images['tmp_name'];
    $count = count($filename);
    // echo $count;
    $array = array();

        // for ($i = 0; $i < $count; $i++) {
        //     $indexed_file = $filename[$i];
        //     $path = "upload/" . $indexed_file;
        //     move_uploaded_file($file_tmp_name[$i], $path);
        //     array_push($array, $path);
        // }
        // $string = implode(",", $array);
        // // echo $string;

        // $sql = "INSERT INTO `files_upload` (filename) VALUES ('$string')";
        // $result = mysqli_query($conn, $sql);
        // if ($result) {
        //     echo "inserted";
        // } else {
        //     echo "not inserted";
        // }

}

?>