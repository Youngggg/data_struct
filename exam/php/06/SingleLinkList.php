<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-21
 * Time: 15:18
 */
include './SingleLinkListssNode.php';
class SingleLinkList
{
    /**
     * 单链表头节点 哨兵节点
     *
     * @var SingleLinkListssNode
     */
    public $head;

    /**
     * 单链表长度
     *
     * @var
     */
    public $length;

    /**
     * 初始化单链表
     *
     * SingleLinkList constructor
     *
     * @param null $head
     */
    public function __construct($head = null)
    {
        if (null == $head) {
            $this->head = new SingleLinkListssNode();
        } else {
            $this->head = $head;
        }

        $this->length = 0;
    }

    /**
     * 获取链表长度
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 插入数据 采用头插法
     *
     * @param $data
     *
     * @return SingleLinkListssNode|bool
     */
    public function insert($data)
    {
        return $this->insertDataAfter($this->head, $data);
    }

    /**
     * 在某个节点后插入新的节点  直接插入数据
     *
     * @param SingleLinkListssNode $originNode
     * @param $data
     *
     * @return SingleLinkListssNode|bool
     */
    public function insertDataAfter(SingleLinkListssNode $originNode, $data)
    {
        // 如果$originNode为空 插入失败
        if (null == $originNode) {
            return false;
        }

        // 新建单链表节点
        $newNode = new SingleLinkListssNode();
        // 新节点的数据
        $newNode->data = $data;

        // 新节点的下一个节点为源节点的下一个节点
        $newNode->next = $originNode->next;
        // 在源节点后插入新节点
        $originNode->next = $newNode;

        // 链表长度
        $this->length++;

        return $newNode;
    }

    /**
     * 在某个节点后插入新的节点
     *
     * @param SingleLinkListssNode $originNode
     * @param SingleLinkListssNode $node
     *
     * @return SingleLinkListssNode|bool
     */
    public function insertNodeAfter(SingleLinkListssNode $originNode, SingleLinkListssNode $node)
    {
        // 如果$origin为空 插入失败
        if (null == $originNode) {
            return false;
        }

        $node->next = $originNode->next;
        $originNode->next = $node;

        $this->length++;

        return $node;
    }

    /**
     *删除节点
     *
     *@param SingleLinkListssNode $node
     *
     *@return bool
     */
    public function delete(SingleLinkListssNode $node)
    {
        if (null == $node) {
            return false;
        }

        // 获取删除节点的前置节点
        $preNode = $this->getPreNode($node);

        // 修改指针指向
        $preNode->next = $node->next;
        unset($node);

        $this->length--;
        return true;
    }

    /**
     * 通过索引获取节点
     *
     * @param int $index
     *
     * @return SingleLinkListssNode|null
     */
    public function getNodeByIndex($index)
    {
        if ($index >= $this->length) {
            return null;
        }

        $cur = $this->head->next;
        for ($i=0; $i<$index; $i++) {
            $cur = $cur->next;
        }

        return $cur;
    }

    /**
     *  获取某个节点的前置节点
     *
     * @param SingleLinkListssNode $node
     *
     * @return SingleLinkListssNode|bool
     */
    public function getPreNode(SingleLinkListssNode $node)
    {
        if (null == $node) {
            return false;
        }

        $curNode = $this->head;
        $preNode = $this->head;
        // 遍历找到前置节点 用全等判断是否是同一个对象
        while ($curNode !== $node && $curNode != null) {
            $preNode = $curNode;
            $curNode = $curNode->next;
        }

        return $preNode;
    }

    /**
     * 输出单链表 当data的数据为可输出类型
     *
     * @return bool
     */
    public function printList()
    {
        if (null == $this->head->next) {
            return false;
        }

        $curNode = $this->head;
        // 防止链表带环 控制遍历次数
        $listLength = $this->getLength();
        while ($curNode->next != null && $listLength--) {
            echo $curNode->next->data . ' -> ';
            $curNode = $curNode->next;
        }

        echo 'NULL' . PHP_EOL;

        return true;
    }

    /**
     * 输出单链表 当data的数据为可输出类型
     *
     * @return bool
     */
    public function printListSimple()
    {
        if (null == $this->head->next) {
            return false;
        }

        $curNode = $this->head;
        while ($curNode->next != null) {
            echo $curNode->next->data . ' -> ';

            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;

        return true;
    }

    /**
     * 构造一个有环的链表
     */
    public function buildHasCircleList()
    {
        $data = [1, 2, 3, 4, 5, 6, 7, 8];

        $node0 = new SingleLinkListssNode($data[0]);
        $node1 = new SingleLinkListssNode($data[1]);
        $node2 = new SingleLinkListssNode($data[2]);
        $node3 = new SingleLinkListssNode($data[3]);
        $node4 = new SingleLinkListssNode($data[4]);
        $node5 = new SingleLinkListssNode($data[5]);
        $node6 = new SingleLinkListssNode($data[6]);
        $node7 = new SingleLinkListssNode($data[7]);

        $this->insertNodeAfter($this->head, $node0);
        $this->insertNodeAfter($node0, $node1);
        $this->insertNodeAfter($node1, $node2);
        $this->insertNodeAfter($node2, $node3);
        $this->insertNodeAfter($node3, $node4);
        $this->insertNodeAfter($node4, $node5);
        $this->insertNodeAfter($node5, $node6);
        $this->insertNodeAfter($node6, $node7);

        $node7->next = $node4;
    }
}