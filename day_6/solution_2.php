<?php

$input = file_get_contents('input');

$temp_banks = explode("\t", $input);

$banks = [];

foreach ($temp_banks as $temp_block) {
    $banks[] = (int)$temp_block;
}


$configs = [];
$current_config = implode($banks);
$cycles = 0;
$max_redistribution_index = count($banks) - 1;

while (!in_array($current_config, $configs)) {
    $configs[] = $current_config;
    
    $highest_bank_index = null;
    $bank_value_to_redistribute = null;

    for ($i=0; $i < count($banks); $i++) { 
        if ($banks[$i] > $bank_value_to_redistribute) {
            $bank_value_to_redistribute = $banks[$i];
            $highest_bank_index = $i;
        }
    }

    $banks[$highest_bank_index] = 0;

    $redistribution_index = $highest_bank_index + 1;

    while ($bank_value_to_redistribute > 0) {

        if ($redistribution_index > $max_redistribution_index) {
            $redistribution_index = 0;
        }
        
        $banks[$redistribution_index] += 1;

        $redistribution_index++;

        $bank_value_to_redistribute--;
    }

    $current_config = implode($banks);

    $cycles++;

    //echo "Current cycle: " .  $cycles . "\n";
}

$duplicate_config = $current_config;
//var_dump($banks, $current_config);

echo "Cycles: " .  $cycles . "\n";

$configs_two = [];
$current_config = implode($banks);
$cycles_two = 0;
$max_redistribution_index = count($banks) - 1;

//var_dump($duplicate_config);

while (true) {
    $configs_two[] = $current_config;
    
    $highest_bank_index = null;
    $bank_value_to_redistribute = null;

    for ($i=0; $i < count($banks); $i++) { 
        if ($banks[$i] > $bank_value_to_redistribute) {
            $bank_value_to_redistribute = $banks[$i];
            $highest_bank_index = $i;
        }
    }

    $banks[$highest_bank_index] = 0;

    $redistribution_index = $highest_bank_index + 1;

    while ($bank_value_to_redistribute > 0) {

        if ($redistribution_index > $max_redistribution_index) {
            $redistribution_index = 0;
        }
        
        $banks[$redistribution_index] += 1;

        $redistribution_index++;

        $bank_value_to_redistribute--;
    }

    $current_config = implode($banks);

    if (array_count_values($configs_two)[$duplicate_config] === 2) {
        break;
    }

    $cycles_two++;

    //echo "Current cycle: " .  $cycles_two . "\n";   
}

//var_dump(array_count_values($configs_two)[$duplicate_config]);

//var_dump($banks, $current_config, $configs_two);

echo "Cycles second run: " .  $cycles_two . "\n";