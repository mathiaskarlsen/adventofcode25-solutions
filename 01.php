<?php
$file_array = file(__dir__ . '/inputs/01.txt');
/* echo $file_array[1][0]; */
$position = 50;
$zero_count = 0;
foreach ($file_array as $line) {
    $direction = $line[0];
    $distance = chop(substr($line, 1));
    if ($direction == 'R') {
	$position += $distance;
    }
    if ($direction == 'L') {
	$position -= $distance;
    }
    while ($position > 99) {
	$position -= 100;
    }
    while ($position < 0) {
	$position += 100;
    }
    if ($position == 0) {
	$zero_count += 1;
    }
    /* echo "$direction $distance\n"; */
    /* echo "$position $zero_count\n"; */
};
echo "part 1: $zero_count\n";

$position = 50;
$zero_count = 0;
foreach ($file_array as $line) {
    $direction = $line[0];
    $distance = chop(substr($line, 1));
    if ($direction == 'R') {
	$position += $distance;
    }
    if ($direction == 'L') {
	if ($position == 0) {
	    $position = 100 - $distance;
	} else {
	    $position -= $distance;
	}
    }
    while ($position > 99) {
	if ($position != 100) {
	    $zero_count += 1;
	}
	$position -= 100;
    }
    while ($position < 0) {
	$zero_count += 1;
	$position += 100;
    }
    if ($position == 0) {
	$zero_count += 1;
    }
    /* echo "$direction $distance\n"; */
    /* echo "$position $zero_count\n"; */
};
echo "part 2: $zero_count\n";
