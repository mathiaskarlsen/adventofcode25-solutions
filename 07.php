<?php
$file_array = file(__dir__ . '/inputs/07.txt', FILE_IGNORE_NEW_LINES);
$start_pos = strpos($file_array[0], 'S');
echo $start_pos;
foreach ($file_array as $line) {
	echo "$line\n";
	echo "  ";
}
