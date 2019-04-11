<?php

function bubble_sort(&$arr) {
    $len = count($arr);
    for ($i=0; $i<$len-1; $i++) {
        $flag = false;
        for($j=0; $j<$len-1-$i; $j++) {
            if ($arr[$j] > $arr[$j+1]) {
                 swap($arr[$j], $arr[$j+1]);
	             $flag = true;
            }
        }
        if (!$flag) {break;}
    }
}

function swap(&$x, &$y) {
    $t = $x;
    $x = $y;
    $y = $t;
}

$arr = [4,5,6,3,2,1];
$t1 = microtime(true);

bubble_sort($arr);

$mem = memory_get_peak_usage(true);
$t2 = microtime(true);
echo '耗时: '.round($t2 - $t1, 4).'秒';
echo "\n内存:", $mem / (1024 * 1024), "\n";
var_dump($arr);

