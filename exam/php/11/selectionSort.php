<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-04
 * Time: 19:26
 */

function selectionSort(&$arr){
    $len = count($arr);
    if ($len <= 1) {
        return $len;
    }

    for ($i=0; $i<$len; $i++) {
        $min = $i;
        for ($j=$i+1; $j<$len; $j++) {
            if ($arr[$min] > $arr[$j]) {
                $min = $j;
            }
        }
        swap($arr[$min], $arr[$i]);
    }
}

function swap(&$x, &$y) {
    $t = $x;
    $x = $y;
    $y = $t;
}