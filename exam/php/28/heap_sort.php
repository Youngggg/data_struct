<?php
function swap(&$x, &$y) {
    $t = $x;
    $x = $y;
    $y = $t;
}

function max_heapify(&$arr, $start, $end) {
    //建立父節點指標和子節點指標
    $dad = $start;
    $son = $dad * 2 + 1;
    if ($son >= $end)//若子節點指標超過範圍直接跳出函數
        return;
    if ($son + 1 < $end && $arr[$son] < $arr[$son + 1])//先比較兩個子節點大小，選擇最大的
        $son++;
    if ($arr[$dad] <= $arr[$son]) {//如果父節點小於子節點時，交換父子內容再繼續子節點和孫節點比較
        swap($arr[$dad], $arr[$son]);
        max_heapify($arr, $son, $end);
    }
}

function heap_sort($arr) {
    $len = count($arr);
    //初始化，i從最後一個父節點開始調整
    for ($i = ceil($len/2) - 1; $i >= 0; $i--)
        max_heapify($arr, $i, $len);
    //先將第一個元素和已排好元素前一位做交換，再從新調整，直到排序完畢
//    for ($i = $len - 1; $i > 0; $i--) {
//        swap($arr[0], $arr[$i]);
//        max_heapify($arr, 0, $i);
//    }
    return $arr;
}

$arr = array(3, 5, 3, 0, 8, 6, 1, 5, 8, 6, 2, 4, 9, 4, 7, 0, 1, 8, 9, 7, 3, 1, 2, 5, 9, 7, 4, 0, 2, 6);
$arr = heap_sort($arr);
for ($i = 0; $i < count($arr); $i++)
    echo $arr[$i] . ' ';