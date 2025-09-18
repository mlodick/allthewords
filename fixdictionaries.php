<?php

$dictionary = file_get_contents('words_dictionary.json');
$words = array_keys(json_decode($dictionary, true));


$fixed = [];

foreach ($words as $word) {
    if (preg_match("/[^a-zA-Z]/", $word)) {
        continue;
    }

    if (strlen($word) < 4) {
        continue;
    }

    $fixed[strtolower($word)] = true;
}

ksort($fixed);
file_put_contents("words-extended.json", json_encode(array_keys($fixed)));

