<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-26
 * Time: 10:49
 */
class BM
{
    private static $size = 256;

    public static function generateBC($str, $len)
    {
        $bad_hash = [];
        for ($i=0; $i<self::$size; $i++) {
            $bad_hash[$i] = -1;
        }
        for ($i=0; $i<$len; $i++) {
            $bad_hash[ord($str[$i])] = $i;
        }
        return $bad_hash;
    }

    public static function generateGS($str, $len, &$suffix, &$prefix)
    {
        //初始化
        for ($i=0; $i<$len; $i++) {
            $suffix[$i] = -1;
            $prefix[$i] = false;
        }

        for ($i=0; $i<$len-1; $i++) {
            $j=$i;
            $k=0;//公共后缀子串长度
            while ($j>=0 && $str[$j] == $str[$len-1-$k]) {
                $j--;
                $k++;
                $suffix[$k] = $j+1;
            }
            if ($j == -1) {
                $prefix[$k] = true;
            }
        }
    }

    public static function moveByGS($j, $search_len, $suffix, $prefix)
    {
        $k = $search_len-1-$j; //好后缀长度
        if ($suffix[$k] != -1) {
            return $j - $suffix[$k] + 1;
        }
        for ($r=$j+2; $r<=$search_len-1; $r++) {
            if ($prefix[$search_len-$r] == true) {
                return $r;
            }
        }
        return $search_len;
    }

    public static function bm_search($str, $search)
    {
        $str_len = strlen($str);
        $search_len = strlen($search);
        //构建坏字符HASH表
        $bad_hash = self::generateBC($search, $search_len);
        //构建后缀子串表
        $suffix = $prefix = [];
        self::generateGS($search, $search_len, $suffix, $prefix);
        // $i表示主串与模式串对齐的第一个字符
        $i = 0;
        while ($i <= $str_len-$search_len) {
            //模式串从后向前匹配
            for ($j = $search_len-1; $j>=0; $j--) {
                if ($str[$i+$j] != $search[$j]) {
                    break;
                }
            }
            //匹配成功 返回主串与模式串匹配的第一个字符的位置
            if ($j < 0) {
                return $i;
            }
            $x = $j - $bad_hash[ord($str[$i+$j])];

            //如果有好后缀 $j表示坏字符对应的模式串中的字符下标
            $y = 0;
            var_dump($x+$i);
            if ($j < $search_len-1) {
                $y = self::moveByGS($j, $search_len, $suffix, $prefix);
                var_dump($y+$i);
            }
            $i = $i+max($x, $y);
        }
        return -1;
    }
}

$bm = new BM();
$str = 'abcdabccabdcbacabcab';
$search = 'cabcab';
var_dump($bm::bm_search($str, $search));

