<?php

// Part 1, get the root program

$input = file_get_contents('input');

$temp_lines = explode("\n", $input);

$programs = [];
$program_names = [];
$child_programs = [];

foreach ($temp_lines as $line) {
    $temp_line = explode(' -> ', $line);
    $temp_name_and_weight = explode(' ', $temp_line[0]);

    $program_names[] = $temp_name_and_weight[0];

    $temp_children = [];

    if (isset($temp_line[1])) {
        $temp_children = explode(', ', $temp_line[1]);

        foreach ($temp_children as $child) {
            $program_names[] = $child;
            $child_programs[] = $child;
        }
    }

    $programs[$temp_name_and_weight[0]] = [
        'name' => $temp_name_and_weight[0],
        'weight' => (int)substr($temp_name_and_weight[1], 1, strlen($temp_name_and_weight[1]) - 2),
        'children' => $temp_children
    ];
}

// Only keep the names that exist in $program_names but not in $child_programs, 
// since the only program that is not a child, must be the root program.
$root_program = array_pop(array_diff($program_names, $child_programs));

echo "Root program: " . $root_program . " \n";



// Part 2, calculate new weight for the unbalanced program

function calculateTotalWeight($program, $programs)
{
    $program['total_weight'] = $program['weight'];

    foreach ($program['children'] as $child) {
        $programs = calculateTotalWeight($programs[$child], $programs);
        $program['total_weight'] += $programs[$child]['total_weight'];
    }

    $programs[$program['name']] = $program;

    return $programs;
}

$programs = calculateTotalWeight($programs[$root_program], $programs);

/*foreach ($programs as $program) {
    echo "Program: " . $program['name'] . ". Weight: " . $program['total_weight'] . ". \n";
}*/

$consensus = 0;
$new_weight = 0;
$rogue_program = $root_program;

while (true) {
    $program = $programs[$rogue_program];
    if (!count($program['children'])) {
        // program has to change its weight to consensus
        $new_weight = ($program['weight']  + ($consensus - $program['total_weight']));
        break;
    }

    $weights_of_children = array_map(function($child) use ($programs) {
        return $programs[$child]['total_weight']; 
    }, $program['children']);

    $min_child_weight = min($weights_of_children);
    $max_child_weight = max($weights_of_children);

    if ($min_child_weight == $max_child_weight) {
        // program has to change its weight
        $new_weight = ($program['weight']  + ($consensus - $program['total_weight']));
        break;
    }

    $mins = array_filter($program['children'], function ($child) use ($min_child_weight, $programs) {
        return $programs[$child]['total_weight'] == $min_child_weight; 
    });

    $maxs = array_filter($program['children'], function ($child) use ($max_child_weight, $programs) {
        return $programs[$child]['total_weight'] == $max_child_weight;
    });

    if (count($mins) == 1) {
        // this is the rogue child
        $consensus = $max_child_weight;
        $rogue_program = end($mins);
    }
    else {
        // the max one is the rogue child
        $consensus = $min_child_weight;
        $rogue_program = end($maxs);
    }
}

echo "New weight for " . $rogue_program . ": " . $new_weight . "\n";