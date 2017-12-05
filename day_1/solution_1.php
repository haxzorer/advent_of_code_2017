<?php

$input = file_get_contents('input');

$split = str_split($input);

$split_count = count($split);

$solution = [];

//var_dump($split_count);

for ($i=0; $i < $split_count; $i++) { 
    //echo $i . ':' . $split_count . "\n";
    if ($i === $split_count - 1) {
        if ($split[$i] === $split[0]) {
            $solution[$i] = $split[$i];
        } else {
            $solution[$i] = (string)0;
        }
    } else {
        if ($split[$i] === $split[$i + 1]) {
            $solution[$i] = $split[$i];
        } else {
            $solution[$i] = (string)0;
        }
    }
}

$solution_string = implode($solution);

$solution_sum = 0;

for ($i=0; $i < count($solution); $i++) { 
    $solution_sum += $solution[$i];
}

echo $solution_sum;

//echo $solution_string;