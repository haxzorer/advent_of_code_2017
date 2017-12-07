<?php

$input = file_get_contents('input');

$temp_lines = explode("\n", $input);

$programs = [];
$child_programs = [];

foreach ($temp_lines as $line) {
    $temp_line = explode(' -> ', $line);
    $temp_name_and_weight = explode(' ', $temp_line[0]);

    $programs[] = $temp_name_and_weight[0];

    $temp_children = [];

    if (isset($temp_line[1])) {
        $temp_children = explode(', ', $temp_line[1]);

        foreach ($temp_children as $child) {
            $programs[] = $child;
            $child_programs[] = $child;
        }
    }
}

$root_program = array_pop(array_diff($programs, $child_programs));

echo "Root program: " . $root_program . " \n";