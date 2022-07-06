<?php

$conn = mysqli_connect('localhost', 'root', '', 'e-shop');

if (!$conn)
    die(mysqli_connect_error($res));

$encryptionKey = "Online-Shopping";
$initVector = "1234567891011121";
$encryptionAlgo = "AES-128-CTR";