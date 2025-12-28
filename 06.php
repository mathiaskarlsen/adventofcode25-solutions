<?php
$file_array = file(__dir__ . '/inputs/06.txt', FILE_IGNORE_NEW_LINES);
$test = explode(' ', $file_array[0]);
$numbers = [];
$num_lines = count($file_array);
for ($i = 0; $i < $num_lines-1; $i++) {
    $string = $file_array[$i];
    // regex: finds blocks of space characters of any size
    array_push($numbers, array_map('intval', preg_split('/\s+/', trim($string))));
}
$operators = preg_split('/\s+/', trim($file_array[$num_lines-1]));

$sum = 0;
for ($i = 0; $i < count($operators); $i++) {
    $problem_nums = [];
    for ($j = 0; $j < count($numbers); $j++) {
	array_push($problem_nums, $numbers[$j][$i]);
    }
    if ($operators[$i] == '*') {
	$sum += array_product($problem_nums);
    }
    elseif ($operators[$i] == '+') {
	$sum += array_sum($problem_nums);
    }
    else {
	echo "This should never happen\n";
    }
}
echo "Part 1: $sum\n";

$numbers = array_slice($file_array, 0, $num_lines-1);
$operators = $file_array[$num_lines-1];

$sum = 0;
$current_problem_position = 0;
$next_plus = -1;
$next_mult = -1;
while ($next_mult || $next_plus) {
    $next_plus = strpos($file_array[$num_lines-1], '+', $current_problem_position+1);
    $next_mult = strpos($file_array[$num_lines-1], '*', $current_problem_position+1);
    $next_problem_position = min($next_mult, $next_plus);
    if (!$next_mult && !$next_plus) {
	$next_problem_position = strlen($operators)+1;
    }
    if (!$next_problem_position) {
	$next_problem_position = max($next_mult, $next_plus);
    }
    $problem_nums = [];
    for ($i = $current_problem_position; $i < $next_problem_position-1; $i++) {
	$c = [];
	for ($j = 0; $j < count($numbers); $j++) {
	    array_push($c, $numbers[$j][$i]);
	}
	array_push($problem_nums, (int) implode('', $c));
    }

    if ($operators[$current_problem_position] == '*') {
	$sum += array_product($problem_nums);
	/* echo implode(' * ', $problem_nums) . " = "; */
	/* echo array_product($problem_nums); */
	/* echo "\n"; */
    }
    elseif ($operators[$current_problem_position] == '+') {
	$sum += array_sum($problem_nums);
	/* echo implode(' + ', $problem_nums) . " = "; */
	/* echo array_sum($problem_nums); */
	/* echo "\n"; */
    }
    else {
	echo "This should never happen\n";
    }

    $current_problem_position = $next_problem_position;
}
echo "Part 2: $sum\n";
