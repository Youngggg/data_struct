<?php

function insertion_sort(&$arr) {
    $len = count($arr);
    for ($i=1; $i<$len; $i++) {
        if ($arr[$i-1] > $arr[$i]) {
            $temp = $arr[$i];
            for ($j = $i-1; $j >= 0; $j--) {
                if ($arr[$j] > $temp) {
                    $arr[$j + 1] = $arr[$j];
	  } else {
                    break;
                }
            }
            $arr[$j + 1] = $temp;                
        }
    }
}

$arr = [4,5,6,3,2,1];
$t1 = microtime(true);

insertion_sort($arr);

$mem = memory_get_peak_usage(true);
$t2 = microtime(true);
echo '耗时: '.round($t2 - $t1, 4).'秒';
echo "\n内存:", $mem / (1024 * 1024), "\n";
var_dump($arr);
