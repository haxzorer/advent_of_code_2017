<?php

$input = file_get_contents('input');

$lines = explode("\n", $input);

$numbers = [];

foreach ($lines as $line) {
    $numbers[] = (int)$line;
}

$current_position = 0;
$end_of_maze = count($numbers);
$steps_taken = 0;

//var_dump($numbers);

while ($current_position < $end_of_maze) {
    //echo "Current position " . $current_position . "\n";
    $steps_to_take = $numbers[$current_position];
    //echo "Steps to take " . $steps_to_take . "\n";
    $numbers[$current_position]++;
    //echo "Steps to take next time on same position " . $numbers[$current_position] . "\n";
    $current_position += $steps_to_take;
    //$steps_taken += $steps_to_take;
    $steps_taken++;
    //echo "Steps taken " . $steps_taken . "\n";
}

//echo "Numbers after maze: \n";

//var_dump($numbers);

echo $steps_taken . "\n";