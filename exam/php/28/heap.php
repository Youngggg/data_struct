<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-21
 * Time: 16:09
 */

class Heap
{
    static public $arr = []; //数组 从下标1开始存数据
    static public $n; //堆可以存储的最大数据个数
    static public $count; //堆已存储的数据个数

    public function __construct($capacity=0)
    {
        self::$arr = [];
        self::$n = $capacity;
        self::$count = 0;
    }

    public function insert($data)
    {
        if (self::$count == self::$n) { //堆满了
            return;
        }
        ++self::$count;
        self::$arr[self::$count] = $data;
        $this->heapify();
    }

    public function heapSort()
    {
        $arr = [];
        while (self::$count > 0) {
            $arr[] = self::$arr[1];
            $this->removeMax();
        }
        return $arr;
    }

    public function removeMax()
    {
        if (self::$count == 0) {
            return;
        }
        self::$arr[1] = self::$arr[self::$count];
        unset(self::$arr[self::$count]);
        --self::$count;
        $this->topHeapify();
    }

    //自下往上堆化 最大堆
    public function heapify()
    {
        $n = self::$count;
        while ($n > 1) {
            $parent = self::$arr[$n >> 1];
            if (self::$arr[$n] > $parent) {
                $this->swap(self::$arr[$n], self::$arr[$n >> 1]);
            }
            $n = $n >> 1;
        }
    }

    //自上往下堆化 最大堆
    public function topHeapify()
    {
        $i = 1;
        while (true) {
            $maxPos = $i;
            if ($i*2 <= self::$count && self::$arr[$i] < self::$arr[$i*2]) {
                $maxPos = $i*2;
            }
            if ($i*2+1 <= self::$count && self::$arr[$maxPos] < self::$arr[$i*2+1]) {
                $maxPos = $i*2+1;
            }
            if ($maxPos == $i) break;
            $this->swap(self::$arr[$i], self::$arr[$maxPos]);
            $i = $maxPos;
        }
    }

    public function swap(&$x, &$y) {
        $t = $x;
        $x = $y;
        $y = $t;
    }
}

$heap = new Heap(30);
$heap->insert(5);
$heap->insert(1);
$heap->insert(7);
$heap->insert(4);
$heap->insert(10);
$heap->insert(2);
$heap->insert(18);
$heap->insert(12);
$heap->insert(6);
$heap->insert(87);
$heap->insert(35);
$heap->insert(99);
$heap->insert(41);
$heap->insert(23);
$heap->insert(20);

//$heap->removeMax();

//var_dump($heap->heapSort());

var_dump($heap::$arr);

