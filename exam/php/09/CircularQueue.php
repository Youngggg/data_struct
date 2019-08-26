<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-25
 * Time: 17:43
 */
class CircularQueue
{
    private $MaxSize;
    private $data = [];
    private $head = 0;
    private $tail = 0;

    /**
     * 初始化队列大小 最后位置不存放数据 实际大小=size++
     */
    public function __construct($size = 10)
    {
        $this->MaxSize = ++$size;
    }

    /**
     * 插入队列
     * 队列满条件 ($this->tail+1) % $this->MaxSize == $this->head
     */
    public function enqueue($data)
    {
        if (($this->tail+1) % $this->MaxSize == $this->head) {
            return false;
        }

        $this->data[$this->tail] = $data;
        $this->tail = (++$this->tail) % $this->MaxSize;

    }

    public function dequeue()
    {
        if ($this->head == $this->tail)
            return NULL;

        $data = $this->data[$this->head];
        unset($this->data[$this->head]);
        $this->head = (++$this->head) % $this->MaxSize;
        return $data;
    }

    public function getLength()
    {
        return ($this->tail - $this->head + $this->MaxSize) % $this->MaxSize;
    }


}

$queue = new CircularQueue(4);
$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);
$queue->enqueue(4);
var_dump($queue);

 $queue->enQueue(5);
var_dump($queue->getLength());
$queue->dequeue();
$queue->dequeue();
$queue->dequeue();
$queue->dequeue();
$queue->dequeue();
var_dump($queue);