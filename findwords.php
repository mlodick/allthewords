<?php

$usage = "php findwords.php letters [starts_with] [exact_length]";

if ($argc < 2) {
    die("Usage: $usage\n");
}

$letters = $argv[1];

if (preg_match("/[^a-zA-Z]/", $letters)) {
    die("Usage: $usage\n");
}

$letterArray = str_split( strtolower($letters));
$mustLetter = $letterArray[0];
$letters = implode("", array_unique($letterArray));

$startsWith = !empty($argv[2]) ? strtolower($argv[2]) : '';
if ($startsWith && preg_match("/[^a-zA-Z]/", $startsWith)) {
    die("Usage: $usage\n");
}

$exactLength = $argv[3] ?? 0;
$exactLength = (int) $exactLength;

$dictionary = file_get_contents('words-extended.json');

foreach (json_decode($dictionary) as $word) {
    if (!str_contains($word, $mustLetter)) {
        continue;
    }

    if ($exactLength && strlen($word) !== $exactLength) {
        continue;
    }

    if ($startsWith) {
        if (!str_starts_with($word, $startsWith)) {
            continue;
        }
    }

    if (!preg_match("/[^$letters]/", $word)) {
        echo $word . "\n";
    }
}