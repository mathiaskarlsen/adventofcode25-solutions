<?php
$file_array = file(__dir__ . '/inputs/02.txt');
$id_range_strings = explode(',', $file_array[0]);


$range_string_to_array = function (string $a) {
    [$start, $end] = explode('-', $a);
    return array($start, chop($end));
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

// Part 2, this solutuion does not work. See: 02_2.php
function invalid_ids2(array $id_range) {
    [$start, $end] = $id_range;
    $invalid_id_set = [];
    $sequence_repeats = strlen($end);
    for ($sequence_length = 1; $sequence_length <= strlen($end) / 2+1; $sequence_length++) {
	echo " - $sequence_length";
	$min_repeats = max(2, floor(strlen($start) / $sequence_length));
	$max_repeats = max(2, floor(strlen($end) / $sequence_length));
	for ($sequence_repeats = $min_repeats; $sequence_repeats <= $max_repeats; $sequence_repeats++) {
	    $sequence = (int) substr($start, 0, $sequence_length);
	    while (str_repeat($sequence, $sequence_repeats) <= $end) {
		$repeated = (int) str_repeat($sequence, $sequence_repeats);
		if ($repeated >= $start and $repeated <= $end) {
		    /* if $repeated not in set -> add to set */
		    if (!in_array($repeated, $invalid_id_set)) {
			array_push($invalid_id_set, $repeated);
		    };
		};
		$sequence += 1;
	    };
	    if (strlen($end) % $sequence_length == 0) {
		$sequence = (int) substr($end, 0, $sequence_length);
		while (str_repeat($sequence, $sequence_repeats) <= $end) {
		    $repeated = (int) str_repeat($sequence, $sequence_repeats);
		    if ($repeated >= $start and $repeated <= $end) {
			/* if $repeated not in set -> add to set */
			if (!in_array($repeated, $invalid_id_set)) {
			    array_push($invalid_id_set, $repeated);
			};
		    };
		    $sequence += 1;
		};
	    };
	};
    };
    echo " - ", array_sum($invalid_id_set);
    return array_sum($invalid_id_set);
};

$sum_invalid_ids = 0;
foreach ($id_ranges as $id_range) {
    echo "$id_range[0] - $id_range[1]";
    $sum_invalid_ids += invalid_ids2($id_range);
    echo " - $sum_invalid_ids";
    echo " - Done\n";
};

echo "Part 2: $sum_invalid_ids\n";
