<?php
$file_array = file(__dir__ . '/inputs/03.txt');
$joltage_sum = 0;
$line_length = strlen(chop($file_array[0]));
foreach ($file_array as $line) {
    $line = chop($line);

    $first = '';
    $second = '';
    // First digit
    for ($i = 9; $i > 0; $i--) {
	if (str_contains($line, $i)) {
	    $position = strpos($line, (string) $i) + 1;
	    if ($position == $line_length) {
		continue;
	    };
	    $first = (string) $i;
	    $line = substr($line, $position);
	    break;
	};
    };
    // Second digit
    for ($i = 9; $i > 0; $i--) {
	if (str_contains($line, $i)) {
	    $position = strpos($line, (string) $i) + 1;
	    $second = (string) $i;
	    break;
	};
    };
    $max_joltage = (int) $first . $second;
    $joltage_sum += $max_joltage;
    /* echo $first . $second; */
    /* echo "\n"; */
};
echo "Part 1: $joltage_sum\n";

// For part 2 i need 12 digits per line instead of 2

$joltage_sum = 0;
define("BATTERIES", 12);
foreach($file_array as $line) {
    $line = chop($line);
    $digits = [];
    for ($digit = 1; $digit <= BATTERIES; $digit++) {
	$line_length = strlen($line);
	for ($i = 9; $i > 0; $i--) {
	    if (!str_contains($line, $i)) {
		continue;
	    };
	    $position = strpos($line, (string) $i) + 1;
	    if ($position > $line_length - BATTERIES + $digit) {
		/* echo "HEY\n"; */
		continue;
	    };
	    array_push($digits, (string) $i);
	    $line = substr($line, $position);
	    break;
	};
    };
    $max_joltage = (int) implode('', $digits);
    $joltage_sum += $max_joltage;
};
echo "Part 2: $joltage_sum\n";
