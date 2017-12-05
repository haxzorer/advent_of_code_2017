<?php

$input = file_get_contents('input');

//$input = "25";


$root = ceil(sqrt($input));
$currrent_row_length = $root % 2 !== 0 ? $root : $root + 1;
$current_row = ($currrent_row_length - 1) / 2;
$cycle = $input - (($currrent_row_length - 2) ** 2);
$inner_offset = $cycle % ($currrent_row_length - 1);

$steps = $current_row + abs($inner_offset - $current_row);

//var_dump($root, $currrent_row_length, $current_row, $cycle, $inner_offset);

echo $steps;