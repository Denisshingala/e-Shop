<?php
function calculateRange($min, $max)
{
$arr = array_fill(0, 5, 0);

$arr[0] = floor($min - ($min % 10));
// $arr[4] = floor($max - ($max % 10));
$arr[4] = floor($max - ($max % 10)) + 10;

$min -= $min % 10;
$max -= $max % 10;

$mid = ($min + $max) / 2;
$arr[2] = floor($mid) - (floor($mid) % 10);

$arr[1] = floor(($arr[0] + $arr[2]) / 2) - (floor(($arr[0] + $arr[2]) / 2) % 10);
$arr[3] = floor(($arr[2] + $arr[4]) / 2) - (floor(($arr[2] + $arr[4]) / 2) % 10);

$arr[0] = 0;

return $arr;

}
?>