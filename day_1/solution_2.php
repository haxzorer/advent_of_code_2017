<?php

$input = file_get_contents('input');

//$input = '1212';

$split = str_split($input);

$split_count = count($split);

$compare_count = $split_count / 2;

$solution = [];

function getComparePosition($input_count, $current_position)
{
    $steps = $input_count / 2;

    $pos = ($current_position + $steps) % $input_count;

    return $pos;

    $halfway = $input_count / 2;
}

//echoLine('Starting with ' . $input);

for ($i=0; $i < $split_count; $i++) { 
    //echoLine('Current digit: ' . $split[$i]);
    //echoLine('Compare to: ' . $split[getComparePosition($split_count, $i)]);
    if ($split[$i] === $split[getComparePosition($split_count, $i)]) {
        $solution[$i] = $split[$i];
    } else {
        $solution[$i] = (string)0;
    }
}

$solution_sum = 0;

for ($i=0; $i < count($solution); $i++) { 
    $solution_sum += $solution[$i];
}

echo $solution_sum . "\n";

//echo $solution_string;

function echoLine($text)
{
    echo $text . "\n";
}