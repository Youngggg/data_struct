<?php

$arr = [53, 542, 3, 63, 14, 214, 154, 748, 616];


function radix_sort(&$arr){
    $k = 0;
    $n = 1;
    $m = 1;
    $temp = [];
    $order = [];
    for($i=0; $i<10; $i++) {
	$order[$i] = 0;
    }
    while($m <= 3) {
	for ($i=0; $i<count($arr); $i++) {
	    $lsd = ($arr[$i] / $n) % 10;
 	    $temp[$lsd][$order[$lsd]] = $arr[$i];
	    $order[$lsd]++;
	}
	for ($i=0; $i<10; $i++) {
	    if($order[$i] != 0) {
		for($j=0; $j<$order[$i]; $j++) {
		    $arr[$k] = $temp[$i][$j];
		    $k++;
		}
	    }
	    $order[$i] = 0;
	}
	$n *= 10;
	$k = 0;
	$m++; 
    }
}

radix_sort($arr);

var_dump($arr);
