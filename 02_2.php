<?php
// brute force solutuion because other faster solution did not work :(
// if you want to try fix the other version, the issue occurs
// in the range 82187 - 123398. The correct answer is: 3089785 
$file_array = file(__dir__ . '/inputs/02.txt');
$id_range_strings = explode(',', $file_array[0]);


$range_string_to_array = function (string $a) {
    [$start, $end] = explode('-', $a);
    return array($start, chop($end));
};
$id_ranges = array_map($range_string_to_array, $id_range_strings);

function invalid_ids2(array $id_range) {
    [$start, $end] = $id_range;
    $invalid_id_set = [];
    for ($i = (int) $start; $i <= (int) $end; $i++) {
	for ($sequence_length = 1; $sequence_length <= strlen($end) / 2; $sequence_length++) {
	    if (strlen($i) % $sequence_length != 0) {
		continue;
	    };
	    $sequence_repeats = max(2, strlen($i) / $sequence_length);
	    $sequence = (int) substr($i, 0, $sequence_length);
	    $repeated = (int) str_repeat($sequence, $sequence_repeats);
	    if ($repeated == $i and !in_array($i, $invalid_id_set)) {
		array_push($invalid_id_set, $repeated);
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
    echo " - Done\n";
};

echo "Part 2: $sum_invalid_ids\n";
