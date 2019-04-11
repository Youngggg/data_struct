<?php

//生成小顶堆函数
function Heap(&$arr,$idx)
{

    $left  = ($idx << 1) + 1;    
    $right = ($idx << 1) + 2;   

    if (!$arr[$left]){        
        return;
    }   

    if($arr[$right] && $arr[$right] < $arr[$left]){        
        $l = $right;
    }else{        
        $l = $left;
    }    
    
    if ($arr[$idx] > $arr[$l]){        
         $tmp = $arr[$idx]; 
         $arr[$idx] = $arr[$l];        
         $arr[$l] = $tmp;

         Heap($arr,$l);
    }

}
//这里为了保证跟上面一致，也构造500w不重复数
/*

  当然这个数据集并不一定全放在内存，也可以在

  文件里面，因为我们并不是全部加载到内存去进

  行排序

*/
for($i=0;$i<100;$i++){    
    $numArr[] = $i;    
}
//打乱它们shuffle($numArr);
//先取出10个到数组$topArr = array_slice($numArr,0,10);
//获取最后一个有子节点的索引位置
//因为在构造小顶堆的时候是从最后一个有左或右节点的位置
//开始从下往上不断的进行移动构造（具体可看上面的图去理解）$idx = floor(count($topArr) / 2) - 1;
//生成小顶堆for($i=$idx;$i>=0;$i--){

    Heap($topArr,$i);

}