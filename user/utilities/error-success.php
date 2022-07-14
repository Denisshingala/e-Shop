<?php
$not_found="";
if (isset($_POST['search-btn']) && $_POST['search-text'] !== '') {
    $searchText = $conn->real_escape_string($_POST['search-text']);
    $array = explode(' ', $searchText);

    foreach ($array as $search) {
        $sql = "SELECT * from product WHERE match(title) against(?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            header("location: /e-shop/user/products.php?cid={$row['category_id']}&page_no=1");
        }

        $sql = "SELECT * from category WHERE match(category_name) against(?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            header("location: /e-shop/user/products.php?cid={$row['category_id']}&page_no=1");
        }
    }
    $not_found = "Product not found!";
}

if ($error) { ?>
    <center>
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> <?php echo $error; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </center>
<?php } else if ($success) { ?>
    <center>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully!</strong> <?php echo $success; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </center>
<?php } else if ($not_found) { ?>
    <center>
    <div class='alert alert-info alert-dismissible fade show' role='alert'>
            <?php echo $not_found; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </center>
<?php } ?>