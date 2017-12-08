<?php

$input = file_get_contents('input');

$temp_lines = explode("\n", $input);

$instructions = [];

foreach ($temp_lines as $line) {
    $temp = explode(' ', $line);

    $instructions[] = $temp;
}

$registers = [];
$values = [];

// Initialize all registers
// To make sure we get all register names,
// check both the target register and the conditional register in the instructions.
foreach ($instructions as $instruction) {
    if (!array_key_exists($instruction[0], $registers)) {
        $registers[$instruction[0]] = [
            'name' => $instruction[0],
            'value' => 0
        ];
    }
    if (!array_key_exists($instruction[4], $registers)) {
        $registers[$instruction[4]] = [
            'name' => $instruction[4],
            'value' => 0
        ];
    }
}

foreach ($instructions as $instruction) {
    $target = $instruction[0];
    $operation = $instruction[1];
    $operation_value = (int)$instruction[2];
    $condition = $instruction[5];
    $condition_target = $instruction[4];
    $condition_target_value = (int)$instruction[6];
    
    $do = checkIfConditionIsTrue($condition, $condition_target, $condition_target_value, $registers);

    if ($do) {
        if ($operation == 'inc') {
            $registers[$target]['value'] += ($operation_value);
        } else {
            $registers[$target]['value'] -= ($operation_value);
        }

        $values[] = $registers[$target]['value'];
    }
}

function checkIfConditionIsTrue($condition, $condition_target, $condition_target_value, $registers) {
    $result = false;
    switch ($condition) {
        case '>':
            $result = ($registers[$condition_target]['value'] > $condition_target_value);
            break;
        case '<':
            $result = ($registers[$condition_target]['value'] < $condition_target_value);
            break;
        case '!=':
            $result = ($registers[$condition_target]['value'] != $condition_target_value);
            break;
        case '==':
            $result = ($registers[$condition_target]['value'] == $condition_target_value);
            break;
        case '<=':
            $result = ($registers[$condition_target]['value'] <= $condition_target_value);
            break;
        case '>=':
            $result = ($registers[$condition_target]['value'] >= $condition_target_value);
            break;
        default:
            echo "Invalid condition: " . $condition . "\n";
            break;
    }

    return $result;
}

$current_largest_value = 0;

foreach ($registers as $register) {
    if ($register['value'] > $current_largest_value) {
        $current_largest_value = $register['value'];
    }
}

$largest_value_ever = 0;

foreach ($values as $value) {
    if ($value > $largest_value_ever) {
        $largest_value_ever = $value;
    }
}

echo "Largets register value: " . $current_largest_value . "\n";
echo "Largets register value ever: " . $largest_value_ever . "\n";