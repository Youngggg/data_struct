<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-26
 * Time: 11:26
 */

function insertSort(&$arr)
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    for ($i=1; $i<$len; $i++) {
        $value = $arr[$i];
        $j = $i-1;
        for ($j; $j>=0; $j--) {
            if ($arr[$j] > $value) {
                $arr[$j+1] = $arr[$j];
            } else {
                break;
            }
        }
        $arr[$j+1] = $value;
    }
}

$arr = [5,2,4,6,3,1];
insertSort($arr);
var_dump($arr);