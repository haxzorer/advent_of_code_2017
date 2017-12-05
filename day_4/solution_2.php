<?php

$input = file_get_contents('input');

$phrases_temp = explode("\n", $input);

$phrases = [];

foreach ($phrases_temp as $phrase_temp) {
    $temp_split = explode(' ', $phrase_temp);

    $phrases[] = $temp_split;
}

$valid_phrases = [];
$invalid_phrases = [];





foreach ($phrases as $phrase) {

    $sorted_words = [];

    foreach ($phrase as $word) {
        $temp = str_split($word);

        sort($temp);

        $sorted_words[] = implode($temp);
    }

    $used_words = [];

    foreach ($sorted_words as $word) {
        if (in_array($word, $used_words)) {
            continue;
        }

        $used_words[] = $word;
    }

    if (count($used_words) === count($phrase)) {
        $valid_phrases[] = $phrase;
    } else {
        $invalid_phrases[] = $phrase;
    }
}







echo "Valid phrases: " . count($valid_phrases) . "\n";
echo "Invalid phrases: " . count($invalid_phrases) . "\n";