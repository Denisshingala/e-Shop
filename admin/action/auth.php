<?php
session_start();
if (!isset($_SESSION['email']) && $_SESSION['type'] == 'admin') {
    header("location:/e-shop");
} else if (isset($_SESSION['email']) && $_SESSION['type'] != 'admin') {
    header("location: javascript:history.go(-1)");
}
$error = "";
$success = "";
