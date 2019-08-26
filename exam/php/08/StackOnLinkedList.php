<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-25
 * Time: 11:16
 */

include '../06/SingleLinkListssNode.php';

class StackOnLinkedList
{
    /**
     * 头指针
     *
     * @var SingleLinkListssNode
     */
    public $head;

    /**
     * 栈长度
     *
     * @var
     */
    public $length;

    /**
     *
     * StackOnlinkedList constructor
     */
    public function __construct()
    {
        $this->head = new SingleLinkListssNode();
        $this->head = 0;
    }

    /**
     * 入栈
     *
     * @param $data
     *
     * @return SingleLinkListssNode|bool
     */
    public function push($data)
    {
        return $this->pushData($data);
    }

    /**
     * 入栈 data
     *
     * @param $data
     *
     * @return SingleLinkListssNode|bool
     */
    public function pushData($data)
    {
        $node = new SingleLinkListssNode($data);

        if (!$this->pushNode($node)) {
            return false;
        }

        return $node;
    }

    /**
     * 入栈 node
     *
     * @param SingleLinkListssNode $node
     *
     * @return bool
     */
    public function pushNode(SingleLinkListssNode $node)
    {
        if (null == $node) {
            return false;
        }

        $node->next = $this->head->next;
        $this->head->next = $node;

        $this->length++;
        return true;
    }

    /**
     * 出栈
     *
     * @return bool
     */
    public function pop($data)
    {
        if (0 == $this->length) {
            return false;
        }

        $this->head->next = $this->head->next->next;
        $this->length--;
        return true;
    }

    /**
     * 获取栈顶元素
     *
     * @return SingleLinkListssNode|bool|null
     */
    public function top()
    {
        if ($this->length == 0) {
            return false;
        }

        return $this->head->next;
    }

    /**
     * 打印栈
     */
    public function printSelf()
    {
        if (0 == $this->length) {
            echo 'empty stack' . PHP_EOL;
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

    /**
     * 获取栈长度
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * 判断栈是否为空
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->length > 0 ? false : true;
    }
}