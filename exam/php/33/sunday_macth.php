<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-27
 * Time: 19:42
 */

class sunday_macth
{
    private static $ascii_size = 126;

    public static function getMove($search, $search_len)
    {
        $move = [];
        for ($i=0; $i<self::$ascii_size; $i++) {
           $move[$i] = $search_len+1;
        }
        for ($i=0; $i<$search_len; $i++) {
            $move[ord($search[$i])] = $search_len-$i;
        }
        return $move;
    }

    public static function match($str, $search)
    {
        $str_len = strlen($str);
        $search_len = strlen($search);
        $move = self::getMove($search, $search_len);
        var_dump($move);

        $s=0;//模式串头部在主串位置
        while ($s<=$str_len-$search_len) {
            $j=0;//模式串已经匹配的长度
            while ($str[$s+$j] == $search[$j]) {
                $j++;
                if ($j >= $search_len) {
                    return $s;
                }
            }
            $s += $move[ord($str[$s+$search_len])];
        }
        return -1;
    }
}


$sunday_match = new sunday_macth();
$search = 'substr';
$str = 'searching substring';
var_dump($sunday_match::match($str, $search));
