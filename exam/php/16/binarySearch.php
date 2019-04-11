<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-11
 * Time: 16:39
 */

function binarySearch($arr, $search) {
    $len = count($arr);
    $left = 0;
    $right = $len-1;
    while ($left < $right) {
        $mid = $left + (($right - $left) >> 1);
        if ($arr[$mid == $search]) {
            return $mid;
        } else if($arr[$mid] > $search) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    return -1;
}


