<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:/e-shop");
}
$error = "";
$success = "";
