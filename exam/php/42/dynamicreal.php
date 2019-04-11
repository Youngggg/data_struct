<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-04-02
 * Time: 11:35
 */
class dynamicreal
{
    private $a = ['m', 'i', 't', 'c', 'm', 'u'];
    private $b = ['m', 't', 'a', 'c', 'n', 'u'];
    private $n = 6;
    private $m = 6;
    private $minDist = 100;

    public function lwstBT($i, $j, $edist)
    {
        if ($i == $this->n || $j == $this->m) {
            if ($i < $this->n) {
                $edist += $this->n - $i;
            }
            if ($j < $this->m) {
                $edist += $this->m - $j;
            }
            if ($edist < $this->minDist) {
                $this->minDist = $edist;
            }
            return;
        }
        if ($this->a[$i] == $this->b[$j]) {
            $this->lwstBT($i+1, $j+1, $edist);
        } else {
            $this->lwstBT($i+1, $j, $edist+1); //删除a[i]或者b[j]前添加一个字符
            $this->lwstBT($i, $j+1, $edist+1); //删除b[j]或者a[i]前添加一个字符
            $this->lwstBT($i+1, $j+1, $edist+1); //将a[i]和b[j]替换为相同字符
        }
    }

    public function lwstDP($a, $n, $b, $m)
    {
        $minDist = [];
        for ($i=0; $i<$n; $i++) {
            for ($j=0; $j<$m; $j++) {
                $minDist[$n][$m] = 0;
            }
        }

        for ($j=0; $j<$m; $j++) {
            if ($a[0] == $b[$j]) {
                $minDist[0][$j] = $j;
            } elseif ($j != 0) {
                $minDist[0][$j] = $minDist[0][$j-1] + 1;
            } else {
                $minDist[0][$j] = 1;
            }
        }

        for ($i=0; $i<$n; $i++) {
            if ($a[$i] == $b[0]) {
                $minDist[$i][0] = $i;
            } elseif ($i != 0) {
                $minDist[$i][0] = $minDist[$i-1][0] + 1;
            } else {
                $minDist[$i][0] = 1;
            }
        }

        for ($i=1; $i<$n; $i++) {
            for ($j=1; $j<$m; $j++) {
                if ($a[$i] == $b[$j]) {
                    $minDist[$i][$j] = $this->min($minDist[$i-1][$j]+1, $minDist[$i][$j-1]+1, $minDist[$i-1][$j-1]);
                } else {
                    $minDist[$i][$j] = $this->min($minDist[$i-1][$j]+1, $minDist[$i][$j-1]+1, $minDist[$i-1][$j-1]+1);
                }
            }
        }
    }

    public function min($x, $y, $z)
    {
        $minv = $this->minDist;
        if ($x < $minv) {
            $minv = $x;
        }
        if ($y < $minv) {
            $minv = $y;
        }
        if ($z < $minv) {
            $minv = $z;
        }
        return $minv;
    }
}