<?php

require('../configuration/config.php');
if (isset($_POST['add_item_id'])) {
    $quantity = $_POST['item_quantity'] + 1;
    $sql = "UPDATE `cart` SET `quantity`=? WHERE `product_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $_POST['add_item_id']);
    $stmt->execute();
    echo '<div class="input-group quantity m-auto" style="width: 120px;">
        <div class="input-group-btn">
            <button type="button" class="btn btn-primary btn-minus" onclick="decQuantity(' . $_POST['add_item_id'] . ')">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" class="form-control bg-secondary text-center h-100" value="' . $quantity . '" id="quantity-' . $_POST['add_item_id'] . '" name="p_quantity" min="1" required>
        <div class="input-group-btn">
            <button type="button" class="btn btn-primary btn-plus" onclick="incQuantity(' . $_POST['add_item_id'] . ')">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>';
    $stmt->close();
}

if (isset($_POST['remove_item_id'])) {
    $quantity = $_POST['item_quantity'] - 1;
    $sql = "UPDATE `cart` SET `quantity`=? WHERE `product_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $_POST['remove_item_id']);
    $stmt->execute();
    echo '<div class="input-group quantity m-auto" style="width: 120px;">
        <div class="input-group-btn">
            <button type="button" class="btn btn-primary btn-minus" onclick="decQuantity(' . $_POST['remove_item_id'] . ')">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" class="form-control bg-secondary text-center h-100" value="' . $quantity . '" id="quantity-' . $_POST['remove_item_id'] . '" name="p_quantity" min="1" required>
        <div class="input-group-btn">
            <button type="button" class="btn btn-primary btn-plus" onclick="incQuantity(' . $_POST['remove_item_id'] . ')">
                <i class="fa fa-plus"></i>
            </button>
        <div>
    </div>';
    $stmt->close();
}

if (isset($_POST['colour'])) {
    $sql = "UPDATE `cart` SET `colour`=? WHERE `product_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $_POST['colour'], $_POST['item_id']);
    $stmt->execute();
}

if (isset($_POST['size'])) {
    $sql = "UPDATE `cart` SET `size`=? WHERE `product_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_POST['size'], $_POST['item_id']);
    $stmt->execute();
}
