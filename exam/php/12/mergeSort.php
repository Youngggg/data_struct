<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-07
 * Time: 19:17
 */

function merge_sort(&$arr) {
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $half = ($len>>1) + ($len & 1);
    $arr2d = array_chunk($arr, $half);
    $left = merge_sort($arr2d[0]);
    $right = merge_sort($arr2d[1]);
    while (count($left) && count($right))
        if ($left[0] < $right[0])
            $reg[] = array_shift($left);
        else
            $reg[] = array_shift($right);
    return array_merge($reg, $left, $right);
}


$arr = [0, 2, 4, 1, 9, 8, 5, 11, 29, 13, 12];
merge_sort($arr);
var_dump($arr);
var_dump(4 & 5);
var_dump(2>>1);