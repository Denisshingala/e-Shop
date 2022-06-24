<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:/e-shop");
}
else if(isset($_SESSION['email']) && $_SESSION['type'] != 'seller'){
    header("location: javascript:history.go(-1)");
}
$error = "";
$success = "";
