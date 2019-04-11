<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-27
 * Time: 16:03
 */

class KMP_match
{
    public static function kmp($str, $search)
    {
        $str_len = strlen($str);
        $search_len = strlen($search);
        $next = self::getNext($search, $search_len);
        $j=0;
        for ($i=0; $i<$str_len; $i++) {
            while ($j>0 && $str[$i] != $search[$j]) {
                $j = $next[$j-1] + 1;
            }
            if ($str[$i] == $search[$j]) {
                $j++;
            }
            if ($j==$search_len) {
                return $i-$search_len+1;
            }
        }
        return -1;
    }

    public static function getNext($search, $search_len)
    {
        $next = [];
        $next[0] = -1;
        $k = -1;
        for ($i=1; $i<$search_len; $i++) {
            while ($k != -1 && $search[$k+1] != $search[$i]) {
                $k = $next[$k];
            }
            if ($search[$k+1] == $search[$i]) {
                $k++;
            }
            $next[$i] = $k;
        }
        return $next;
    }
}


$search = 'ababacd';
$str = 'ababaeabacababacd';
$kmp = new KMP_match();
var_dump($kmp::kmp($str, $search));