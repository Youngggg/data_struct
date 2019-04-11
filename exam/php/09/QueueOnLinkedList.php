<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-25
 * Time: 16:54
 */

include '../06/SingleLinkListssNode.php';
class QueueOnLinkedList
{
    /**
     * 队列头节点
     *
     * @var SingleLinkListssNode
     */
    public $head;

    /**
     * 队列尾节点
     *
     * @var null
     */
    public $tail;

    /**
     * 队列长度
     *
     * @var int
     */
    public $length;

    /**
     * QueueOnLinkedList constructor.
     */
    public function __construct()
    {
        $this->head = new SingleLinkListssNode();
        $this->tail = $this->head;

        $this->length = 0;
    }

    /**
     * 入队
     *
     * @param $data
     */
    public function enqueue($data)
    {
        $newNode = new SingleLinkListssNode();
        $newNode->data = $data;

        $this->tail->next = $newNode;
        $this->tail = $newNode;

        $this->length++;
    }

    /**
     * 出队
     *
     * @return SingleLinkListssNode|bool|null
     */
    public function dequeue()
    {
        if (0 == $this->length) {
            return false;
        }

        $node = $this->head->next;
        $this->head->next = $this->head->next->next;

        $this->length--;
        return $node;
    }

    /**
     * 获取队列长度
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 打印队列
     */
    public function printSelf()
    {
        if (0 == $this->length) {
            echo 'empty queue' . PHP_EOL;
            return;
        }

        echo 'head.next -> ';
        $curNode = $this->head;
        while ($curNode->next) {
            echo $curNode->next->data . ' -> ';

            $curNode = $curNode->next;
        }
        echo 'NULL' . PHP_EOL;
    }
}