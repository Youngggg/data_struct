<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-26
 * Time: 10:39
 */

function bubbleSort(&$arr)
{
    $len = count($arr);
    if ($len <= 1) {
        return;
    }

    for ($i=0; $i<$len; $i++){
        $flag = false;
        for ($j=0; $j<$len-$i-1; $j++) {
            if ($arr[$j] > $arr[$j+1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;
                $flag = true;
            }
        }
        if (!$flag) {
            break;
        }
    }
}

$arr = [2,3,1,9,5,7,6,3];
bubbleSort($arr);
var_dump($arr);