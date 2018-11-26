<?php

function selection_sort(&$arr) {
    $len = count($arr);
    for ($i = 0; $i < $len-1; $i++){
        $min = $i;
        for($j =$i+1; $j<$len; $j++) {
            if($arr[$min] > $arr[$j]) {
                $min = $j;
            }
            swap($arr[$min], $arr[$i]);
        }
    }
}

function swap(&$x, &$y){
    $t = $x;
    $x = $y;
    $y = $t;
}

$arr = [4,5,6,3,2,1];
$t1 = microtime(true);

selection_sort($arr);

$mem = memory_get_peak_usage(true);
$t2 = microtime(true);
echo '耗时: '.round($t2 - $t1, 4).'秒';
echo "\n内存:", $mem / (1024 * 1024), "\n";
var_dump($arr);
