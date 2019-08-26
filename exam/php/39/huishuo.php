<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-29
 * Time: 14:56
 */

class huishuo
{
    public $result = [];
    public $maxW = 0;
    /**
     * @return array
     */
    public function cal8queens($row)
    {
        // 8个棋子都放好了 打印结果
        if ($row == 8) {
            $this->printQueens($this->result);
            return;
        }
        for ($column=0; $column<8; $column++) { //每一行都有8中放法
            if ($this->isOK($row, $column)) { //有些方法不满足要求
                $this->result[$row] = $column; //第row行的棋子放到了column列
                $this->cal8queens($row+1); //考察下一行
            }
        }
        return $this->result;
    }

    public function isOk($row, $column) //判断row行放到column列是否合适
    {
        $leftup = $column - 1;
        $rightup = $column + 1;
        for ($i=$row-1; $i>=0; $i--) { //逐行考察每一行
            if ($this->result[$i] == $column) { // 第 i 行的 column 列有棋子吗？
                return false;
            }
            if ($leftup >= 0) { // 考察左上对角线：第 i 行 leftup 列有棋子吗？
                if ($this->result[$i] == $leftup) {
                    return false;
                }
            }
            if ($rightup < 8) {
                if ($this->result[$i] == $rightup) {
                    return false;
                }
            }
            $rightup++;
            $leftup--;
        }
        return true;
    }

    public function printQueens()
    {
        $result = $this->result;
        for ($row=0; $row<8; $row++) {
            for ($column=0; $column<8; $column++) {
                if ($result[$row] == $column) {
                    echo "Q ";
                } else {
                    echo "* ";
                }
            }
            echo "\n";
        }
        echo "\n";
    }


    // cw 表示当前已经装进去的物品的重量和；i 表示考察到哪个物品了；
    // w 背包重量；items 表示每个物品的重量；n 表示物品个数
    // 假设背包可承受重量 100，物品个数 10，物品重量存储在数组 a 中，那可以这样调用函数：
    // f(0, 0, a, 10, 100)
    public function f($i, $cw, $items, $n, $w)
    {
        // cw==w 表示装满了 ;i==n 表示已经考察完所有的物品
        if ($cw == $w || $i == $n) {
            if ($cw > $this->maxW) {
                $this->maxW = $cw;
                return;
            }
        }

        $this->f($i+1, $cw, $items, $n, $w);
        if ($cw + $items[$i] <= $w) {
            $this->f($i+1, $cw+$items[$i], $items, $n, $w);
        }
    }
}

$huishuo = new huishuo();
$huishuo->cal8queens(0);
$huishuo->printQueens();