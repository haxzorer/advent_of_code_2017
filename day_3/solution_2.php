<?php

$input = file_get_contents('input');

$num = (int)$input;

$range = file_get_contents('oeis');

$range_lines = explode("\n", $range);

$range_lines_filtered = [];

foreach ($range_lines as $line) {
    if (strpos($line, '#') === false) {
        $range_lines_filtered[] = (int)explode(' ', $line)[1];
    }
}

$result = null;

foreach ($range_lines_filtered as $filtered_line) {
    if ($filtered_line > $num) {
        $result = $filtered_line;
        break;
    }
}

echo $result . "\n";