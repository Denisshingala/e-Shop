<?php
include('../../configuration/config.php');

if(isset($_POST['add-new-category-btn'])) {
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    if($category == "") {
        echo "Field is empty";
    } 
    else {
        $sql = "INSERT INTO category (category_name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        if($stmt->execute()) {
            header("location: ../categories.php");
        }
        else {
            echo "Unable to add new category due to technical issue";
        }
    }
}

?>