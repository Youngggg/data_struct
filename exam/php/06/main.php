<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-20
 * Time: 15:31
 */

include './SingleLinkList.php';


class main
{
    /**
     * 判断链表保存的字符串是否是回文
     *
     * @param SingleLinkList $list
     *
     * @return bool
     */
    function isPalindrome(SingleLinkList $list)
    {
        if ($list->getLength() <= 1) {
            return true;
        }

        $pre = null;
        $slow = $list->head->next;
        $fast = $list->head->next;
        $remainNode = null;

        //找单链表中点以及反转前半部分链表
        while ($fast != null && $fast->next != null) {
            $fast = $fast->next->next;

            //单链表反转关键代码
            $remainNode = $slow->next;
            $slow->next = $pre;
            $pre = $slow;
            var_dump($pre);
            $slow = $remainNode;
        }

        // 链表长度为ji数的情况下
        if ($fast != null) {
            $slow = $slow->next;
        }

        //开始逐个比较
        while($slow != null) {
            if ($slow->data != $pre->data) {
                return false;
            }
            $slow = $slow->next;
            $pre = $pre->next;
        }

        return true;
    }

    /**
     * 单链表反转
     *
     * @param SingleLinkList $list
     *
     * @return SingleLinkList
     */
    public function reverse(SingleLinkList $list)
    {
        $len = $list->getLength();
        if ($len <= 1)
        {
            return $list;
        }

        $reverse = new SingleLinkList;
        $step = $list->head->next;

        // 控制循环次数 防止链表为循环链表
        while ($step != null && $len--) {
            $cur = $step->next;
            var_dump($step->data);
            $reverse->insert($step->data);
            $step = $cur;
        }

        return $reverse;
    }

    /**
     * 链表中环的检测
     *
     * @param SingleLinkList
     *
     * @return bool
     */
    public function checkLink(SingleLinkList $list) {
        if ($list->getLength() <= 1) {
            return false;
        }

        $fast = $list->head->next;
        $slow = $list->head->next;

        while ($fast != null && $fast->next != null) {
            $fast = $fast->next->next;
            $slow = $slow->next;

            if ($slow === $fast) {
                return true;
            }
        }

        return false;
    }

    /**
     * 两个有序的链表合并
     *
     * @param SingleLinkList $listA
     * @param SingleLinkList $listB
     *
     * @return SingleLinkList
     */
    public function mergeSortLink(SingleLinkList $listA, SingleLinkList $listB) {
        if (null == $listA) {
            return $listB;
        }
        if (null == $listB) {
            return $listA;
        }

        $pListA = $listA->head->next;
        $pListB = $listB->head->next;
        $newList = new SingleLinkList();
        $pNewList = $newList->head;

        while ($pListA != null && $pListB != null) {
            if ($pListA->data <= $pListB->data) {
                $pNewList->next = $pListA;
                $pListA = $pListA->next;
            } else {
                $pNewList->next = $pListB;
                $pListB = $pListB->next;
            }

            $pNewList = $pNewList->next;
        }

        if ($pListB != null) {
            $pNewList->next = $pListB;
        }
        if ($pListA != null) {
            $pNewList->next = $pListA;
        }

        return $newList;
    }
}

$list = new SingleLinkList();
$list->insert('a');
$list->insert('b');
$list->insert('c');
$list->insert('c');
$list->insert('b');
$list->insert('a');

$main = new main();
var_dump($main->isPalindrome($list));
//var_dump($list->printList());
//var_dump($main->reverse($list)->printList());


//$list = new SingleLinkList();
//$list->buildHasCircleList();
//var_dump($list->printList());
//
//$main = new main();
//var_dump($main->checkLink($list));


// 两个有序的链表合并
$listA = new SingleLinkList();
$listA->insert(9);
$listA->insert(7);
$listA->insert(5);
$listA->insert(3);
$listA->insert(1);
$listA->printList();

$listB = new SingleLinkList();
$listB->insert(10);
$listB->insert(8);
$listB->insert(6);
$listB->insert(4);
$listB->insert(2);
$listB->printList();

$main = new main();
var_dump($main->mergeSortLink($listA, $listB)->printListSimple());

