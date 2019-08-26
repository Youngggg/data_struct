<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-26
 * Time: 10:13
 */

function bf_match($str, $search) {
    $str_len = strlen($str);
    $search_len = strlen($search);
    if ($search_len > $str_len) {
        return -1;
    }

    for ($i=0; $i<$str_len; $i++) {
        $str_son = substr($str, $i, $search_len);
        if ($search == $str_son) {
            return $i;
        }
    }
    return -1;
}


$str = 'abcdefghijklmn';
$search = 'lmnl';
var_dump(bf_match($str, $search));