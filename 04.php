<?php
$file_array = file(__dir__ . '/inputs/04.txt', FILE_IGNORE_NEW_LINES);
$width = strlen($file_array[0]);
$height = count($file_array);

function neighbour_count_grid ($grid, $width, $height) {
    $zeros_line = array_fill(0, $width, 0);
    $neighbour_count = array_fill(0, $height, $zeros_line);
    for ($y = 0; $y < $height; $y++) {
	for ($x = 0; $x < $width; $x++) {
	    if ($grid[$y][$x] == '.') {
		continue;
	    }
	    // NW
	    if ($x > 0 && $y > 0) {
		$neighbour_count[$y-1][$x-1] += 1;
	    }
	    // N
	    if ($y > 0) {
		$neighbour_count[$y-1][$x] += 1;
	    }
	    // NE
	    if ($x < $width-1 && $y > 0) {
		$neighbour_count[$y-1][$x+1] += 1;
	    }
	    // E
	    if ($x < $width-1) {
		$neighbour_count[$y][$x+1] += 1;
	    }
	    // SW
	    if ($x > 0 && $y < $height-1) {
		$neighbour_count[$y+1][$x-1] += 1;
	    }
	    // S
	    if ($y < $height-1) {
		$neighbour_count[$y+1][$x] += 1;
	    }
	    // SE
	    if ($x < $width-1 && $y < $height-1) {
		$neighbour_count[$y+1][$x+1] += 1;
	    }
	    // W
	    if ($x > 0) {
		$neighbour_count[$y][$x-1] += 1;
	    }
	}
    }
    return $neighbour_count;
}

$neighbour_count = neighbour_count_grid($file_array, $width, $height);

$accessible_rolls = 0;
for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
	if ($file_array[$y][$x] == '.') {
	    continue;
	}
	if ($neighbour_count[$y][$x] < 4) {
	    $accessible_rolls += 1;
	    $file_array[$y][$x] = '.';
	    continue;
	}
    }
}
echo "Part 1: $accessible_rolls\n";

// Part 2

$new_accessible_rolls = -1;
while ($new_accessible_rolls != 0) {
    $new_accessible_rolls = 0;
    $neighbour_count = neighbour_count_grid($file_array, $width, $height);
    for ($y = 0; $y < $height; $y++) {
	for ($x = 0; $x < $width; $x++) {
	    if ($file_array[$y][$x] == '.') {
		continue;
	    }
	    if ($neighbour_count[$y][$x] < 4) {
		$new_accessible_rolls += 1;
		$file_array[$y][$x] = '.';
		continue;
	    }
	}
    }
    $accessible_rolls += $new_accessible_rolls;
}
echo "Part 2: $accessible_rolls\n";
