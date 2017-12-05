<?php

$input = file_get_contents('input');

$rows_temp = explode("\n", $input);

$rows = [];

for ($i=0; $i < count($rows_temp); $i++) { 
    $temp = [];

    $split = explode("\t", $rows_temp[$i]);

    for ($j=0; $j < count($split); $j++) { 
        $temp[] = (int)$split[$j];
    }

    $rows[] = $temp;
}

$row_results = [];

//echo $input . "\n\n";

for ($i=0; $i < count($rows); $i++) { 
    $current_position = 0;
    $temp = [];

    //var_dump($rows[$i]);

    //var_dump($rows[$i]);
    foreach ($rows[$i] as $row_item) {
        for ($j=0; $j < count($rows[$i]); $j++) { 
            if ($rows[$i][$current_position] !== $rows[$i][$j]) {
                //var_dump($rows[$i][$current_position], $rows[$i][$j]);
                $temp[] = $rows[$i][$current_position] / $rows[$i][$j];
            }

            //var_dump($rows[$i][$current_position], $rows[$i][$j]);

            
        }

        $current_position++;
    }
    

    $row_results[] = $temp;
}

$row_ints = [];

foreach ($row_results as $row_result) {
    foreach ($row_result as $row_result_item) {
        if (is_int($row_result_item)) {
            $row_ints[] = $row_result_item;
        }
    }
}

$sum = 0;

foreach ($row_ints as $row_int) {
    $sum += $row_int;
}

echo $sum . "\n";

