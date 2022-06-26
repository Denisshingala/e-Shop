<?php

// $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
// $dotenv->load();

// $localhost = $_ENV['localhost'];
// $database = $_ENV['database'];
// $username = $_ENV['username'];
// $password = $_ENV['password'];

// $conn = mysqli_connect($localhost, $username, $password, $database);
$conn = mysqli_connect('localhost', 'root', '', 'e-shop');

if (!$conn)
    die(mysqli_connect_error($res));

$encryptionKey = "Online-Shopping";
$initVector = "1234567891011121";
$encryptionAlgo = "AES-128-CTR";