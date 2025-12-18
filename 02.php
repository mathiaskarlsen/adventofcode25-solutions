<?php
$file_array = file(__dir__ . '/inputs/02.txt');
$id_range_strings = explode(',', $file_array[0]);


$range_string_to_array = function (string $a) {
    [$start, $end] = explode('-', $a);
    return array($start, $end);
};


function invalid_ids(array $id_range) {
    [$start, $end] = $id_range;
    if (strlen($start) == strlen($end) and strlen($end) % 2 == 1) {
	return 0;
    };
    $sequence_length = intdiv(strlen($start), 2);
    $sequence = (int) substr($start, 0, $sequence_length);
    $sum = 0;
    while (str_repeat($sequence, 2) <= $end) {
	$repeated = (int) str_repeat($sequence, 2);
	if ($repeated >= $start and $repeated <= $end) {
	    $sum += $repeated;
	};
	$sequence += 1;

    }	

    return $sum;
};

$id_ranges = array_map($range_string_to_array, $id_range_strings);
$sum_invalid_ids = 0;
foreach ($id_ranges as $id_range) {
    $sum_invalid_ids += invalid_ids($id_range);
};

echo "Part 1: $sum_invalid_ids\n";

function invalid_ids2(array $id_range) {
    [$start, $end] = $id_range;
    $sequence_repeats = strlen($end);
    for ($sequence_length = 1; $sequence_length <= strlen($end) / 2; $sequence_length++) {
	$sequence = (int) substr($start, 0, $sequence_length);
	while (strlen(str_repeat($sequence, $sequence_repeats)) > strlen($end)) {
	    $sequence_repeats -= 1;
	};
	while (str_repeat($sequence, $sequence_repeats) <= $end) {
	    $repeated = (int) str_repeat($sequence, $sequence_repeats);
	    if ($repeated >= $start and $repeated <= $end) {
		$sum += $repeated;
	    };
	    $sequence += 1;

	}	
    };
    $sequence_length = 1;
    $sequence = (int) substr($start, 0, $sequence_length);
    $sum = 0;
    while (str_repeat($sequence, 2) <= $end) {
	$repeated = (int) str_repeat($sequence, 2);
	if ($repeated >= $start and $repeated <= $end) {
	    $sum += $repeated;
	};
	$sequence += 1;

    }	

    return $sum;
};

$id_ranges = array_map($range_string_to_array, $id_range_strings);
$sum_invalid_ids = 0;
foreach ($id_ranges as $id_range) {
    $sum_invalid_ids += invalid_ids($id_range);
};

echo "Part 1: $sum_invalid_ids\n";
