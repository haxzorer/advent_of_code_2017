<?php

$input = file_get_contents('input');

$lengths = explode(',', $input);

for ($i=0; $i < count($lengths); $i++) { 
    $lengths[$i] = (int)$lengths[$i];
}

$range = range(0, 255);
$current_position = 0;
$range_size = count($range);
$last_position = $range_size - 1;
$skip_size = 0;

//var_dump($range);

foreach ($lengths as $length) {
    $sub_range = [];

    for ($i = 0; $i < $length; $i++) {
        $sub_range[] = $range[($current_position + $i) % $range_size];
    }

    $sub_range = array_reverse($sub_range);

    for ($i = 0; $i < $length; $i++) {
        $range[($current_position + $i) % $range_size] = $sub_range[$i];
    }

    $current_position += ($length + $skip_size);
    $skip_size++;
}

echo "Result: " . ($range[0] * $range[1]) . "\n"; 
