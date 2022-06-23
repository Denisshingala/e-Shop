<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:/online_shopping/online_shopping/login.php");
}
$error = "";
$success = "";
