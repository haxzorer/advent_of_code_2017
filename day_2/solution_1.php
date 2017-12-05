<?php

$input = file_get_contents('input');

$rows_temp = explode("\n", $input);

$rows_sorted = [];

for ($i=0; $i < count($rows_temp); $i++) { 
    $temp = [];

    $split = explode("\t", $rows_temp[$i]);

    for ($j=0; $j < count($split); $j++) { 
        $temp[] = (int)$split[$j];
    }

    sort($temp, SORT_NUMERIC);

    $rows_sorted[] = $temp;
}

$checksum = 0;

foreach ($rows_sorted as $row) {
    $checksum += ($row[count($row) - 1] - $row[0]);
}

echo $checksum . "\n";