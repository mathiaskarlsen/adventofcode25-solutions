<?php
$file_array = file(__dir__ . '/inputs/05.txt', FILE_IGNORE_NEW_LINES);
$empty_line_loc = array_search('', $file_array, true);
$ranges = array_slice($file_array, 0, $empty_line_loc);
$IDs = array_slice($file_array, $empty_line_loc+1);

$to_array = function ($string_range) {
    return explode('-', $string_range);
};

$ranges = array_map($to_array, $ranges);

$fresh = 0;
foreach ($IDs as $ID) {
    foreach($ranges as $range) {
	[$start, $end] = $range;
	if ($ID >= $start && $ID <= $end) {
	    $fresh += 1;
	    break;
	}
    }
}
echo "Part 1: $fresh\n";

$array_start = function ($a, $b) {
    return $a[0] - $b[0];
};


$processed_ranges = [];
usort($ranges, $array_start);

// Merge overlapping ranges
for ($i = 0; $i < count($ranges); $i++) {
    [$start, $end] = $ranges[$i];
    $overlap = false;
    for ($j = 0; $j < count($processed_ranges); $j++) {
	[$pstart, $pend] = $processed_ranges[$j];
	if ($start >= $pstart && $end <= $pend) {
	    $overlap = true;
	    continue;
	}
	if ($start >= $pstart && $start <= $pend) {
	    $processed_ranges[$j][1] = $end;
	    $overlap = true;
	}
	if ($end >= $pstart && $end <= $pend) {
	    $processed_ranges[$j][0] = $start;
	    $overlap = true;
	}
	if ($overlap) {
	    break;
	}
    }
    if (!$overlap) {
	array_push($processed_ranges, $ranges[$i]);
    }
}

$total_fresh = 0;
foreach ($processed_ranges as $range) {
    [$start, $end] = $range;
    $total_fresh += $end - $start + 1;
}
echo "Part 2: $total_fresh\n";
