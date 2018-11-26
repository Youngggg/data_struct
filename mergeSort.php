<?php
function merge_sort($arr) {
	$len = count($arr);
	if ($len == 1) return $arr;	
	$half = $len >> 1;
	$left = merge_sort(array_slice($arr, 0, $half));
	$right = merge_sort(array_slice($arr, $half));
	return merge_array($left, $right);
}

function merge_array($arr1, $arr2) {
	if (empty($arr1) && empty($arr2)) return false;
	if (empty($arr1)) return $arr2;
	if (empty($arr2)) return $arr1;
	
	$i=$j=0;
	while ($i < count($arr1) && $j < count($arr2)) {
		if ($arr1[$i] < $arr2[$j]) {
			$result[] = $arr1[$i];
			$i++;
		} else {
			$result[] = $arr2[$j];
			$j++;
		}
	}
	if (isset($arr1[$i])) {
		$result = array_merge($result, array_slice($arr1, $i));
	} else {
		$result = array_merge($result, array_slice($arr2, $j));
	}
	return $result;
}

$arr = array(21, 34, 3, 32, 82, 55, 89, 50, 37, 5, 64, 35, 9);
$t1 = microtime(true);
$arr = merge_sort($arr);
$t2 = microtime(true);
$mem = memory_get_peak_usage(true);
echo '耗时: '.round($t2 - $t1, 4).'秒';
echo "\n内存:", $mem / (1024 * 1024), "\n";
var_dump($arr);
