<?php

$input = file_get_contents('input');

$stream = str_split($input);

$in_garbage = false;
$garbage_count = 0;

for ($i=0; $i < count($stream); $i++) { 
    $current_char = $stream[$i];

    if ($current_char == '!') {
        $i++;
        continue;
    }

    switch ($current_char) {
        case '<':
            if ($in_garbage) {
                $garbage_count++;
            } else {
                $in_garbage = true;
            }
            break;
        case '>':
            $in_garbage = false;
            break;
        default:
            if ($in_garbage) {
                $garbage_count++;
            }
            break;
    }
}

echo "Total garbage characters: " . $garbage_count . "\n";