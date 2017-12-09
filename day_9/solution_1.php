<?php

$input = file_get_contents('input');

$stream = str_split($input);

$in_garbage = false;
$filtered_chars = [];

for ($i=0; $i < count($stream); $i++) { 
    $current_char = $stream[$i];

    if ($current_char == '!') {
        $i++;
        continue;
    }

    switch ($current_char) {
        case '<':
            $in_garbage = true;
            break;
        case '>':
            $in_garbage = false;
            break;
        default:
            if (!$in_garbage) {
                $filtered_chars[] = $current_char;
            }
            break;
    }    
}

$current_group_level = 0;
$total_score = 0;

for ($i=0; $i < count($filtered_chars); $i++) { 
    $current_char = $filtered_chars[$i];

    if ($current_char == '{') {
        $current_group_level++;
        $total_score += $current_group_level;
    } elseif ($current_char == '}') {
        $current_group_level--;
    }
}

echo "Total score: " . $total_score . "\n";