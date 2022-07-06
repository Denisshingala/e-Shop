<?php
session_start();

if (isset($_SESSION['item']))
    unset($_SESSION['item']);

if (isset($_SESSION['email'])) {
    if ($_SESSION['type'] == 'seller')
        header("location:/e-shop/seller/dashboard.php");
    else if ($_SESSION['type'] == 'admin') {
        header("location:/e-shop/admin/dashboard.php");
    }
}
$error = "";
$success = "";
