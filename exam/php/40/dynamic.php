<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-04-01
 * Time: 10:19
 */

class Dynamic
{
    /**
     * @param $weight array 物品重量
     * @param $n int 物品个数
     * @param $w int 背包可承载重量
     * @return int
     */
    public function knapsack($weight, $n, $w)
    {
        $states = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $w + 1; $j++) {
                $states[$i][$j] = false;
            }
        }
        $states[0][0] = true; //第一行的数据特殊处理
        $states[0][$weight[0]] = true;

        for ($i = 1; $i < $n; $i++) { //动态规划状态转移
            for ($j = 0; $j <= $w; $j++) { //不把第i个物品放入背包
                if ($states[$i - 1][$j] == true) {
                    $states[$i][$j] = $states[$i - 1][$j];
                }
            }
            for ($j = 0; $j <= $w - $weight[$i]; $j++) {
                if ($states[$i - 1][$j] == true) {
                    $states[$i][$j + $weight[$i]] = true;
                }
            }
        }

        for ($i = $w; $i >= 0; $i--) {
            if ($states[$n - 1][$i] == true) {
                $this->printS($states);
                return $i;
            }
        }
        return 0;
    }

    public static function knapsack2($items, $n, $w)
    {
        $states = [];
        for ($i = 0; $i < $w + 1; $i++) {
            $states[$i] = false;
        }
        $states[0] = true;
        $states[$items[0]] = true;
        for ($i = 0; $i < $n; $i++) {
            for ($j = $w - $items[$i]; $j >= 0; $j--) {
                if ($states[$j] == true) {
                    $states[$j + $items[$i]] = true;
                }
            }
            self::print2($states);
            echo "\n";
        }
        for ($i = $w; $i >= 0; $i--) {
            if ($states[$i] == true) {
                return $i;
            }
        }
    }

    public static function knapsack3($weight, $value, $n, $w)
    {
        $states = [];
        for ($i=0; $i<$n; $i++) {
            for ($j=0; $j<$w+1; $j++) {
                $states[$i][$j] = -1;
            }
        }

        $states[0][0] = 0;
        $states[0][$weight[0]] = $value[0];

        for ($i=1; $i<$n; $i++) {
            for ($j=0; $j<=$w; $j++) {
                if ($states[$i-1][$j] >= 0) {
                    $states[$i][$j] = $states[$i-1][$j];
                }
            }
            for ($j=0; $j<=$w-$weight[$i]; $j++) {
                if ($states[$i-1][$j] >= 0) {
                    $v = $states[$i-1][$j] + $value[$i];
                    if ($v > $states[$i][$j+$weight[$i]]) {
                        $states[$i][$j+$weight[$i]] = $v;
                    }
                }
            }

            self::printS($states);
            echo "\n";
        }
        $maxvalue = -1;
        for ($j=0; $j<=$w; $j++) {
            if ($states[$n-1][$j] > $maxvalue) {
                $maxvalue = $states[$n-1][$j];
            }
        }
        return $maxvalue;
    }

    public static function print2($states)
    {
        for ($i=0; $i<count($states); $i++) {
            if ($states[$i]) {
                echo $states[$i]." ";
            } else {
                echo "* ";
            }
        }
    }

    public static function printS($states) {
        for ($i=0; $i<5; $i++) {
            for ($j=0; $j<=9; $j++) {
                if ($states[$i][$j] !== false) {
                    echo $states[$i][$j]; echo " ";
                } else {
                    echo "*"; echo " ";
                }
            }
            echo "\n";
        }
    }
}

$weight = [2, 2, 4, 6, 3];
$value = [3, 4, 8, 9, 6];
$n=5;
$w=9;
$dynamic = new Dynamic();
//var_dump($dynamic->knapsack($weight, $n, $w));
var_dump($dynamic::knapsack3($weight, $value, $n, $w));
