<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-11
 * Time: 09:28
 */

//function quickSort($arr) {
//    $len = count($arr);
//    if ($len <= 1) {
//        return $arr;
//    }
//
//    $mid_index = $len>>1;
//    $mid_value = $arr[$mid_index];
//    $left = $right = [];
//    for ($i=0; $i<$len; $i++) {
//        if ($i == $mid_index) {
//            continue;
//        }
//        if ($arr[$i] < $mid_value) {
//            $left[] = $arr[$i];
//        } else {
//            $right[] = $arr[$i];
//        }
//    }
//    return array_merge(quickSort($left), [$mid_value], quickSort($right));
//}


function quickSort($arr) {
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $mid = $arr[0];
    $left = $right = [];
    for ($i=1; $i<$len; $i++) {
        if ($arr[$i] < $mid) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }
    return array_merge(quickSort($left), [$mid], quickSort($right));
}


$arr = [2, 4, 1, 11, 100, 32, 77, 51, 10, 22, 49, 90, 10, 20];
//var_dump(quickSort($arr));


var_dump(sort($arr));
var_dump($arr);
