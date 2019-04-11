<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-27
 * Time: 18:17
 */
class AcNode
{
    public $data;
    public $isEndingChar = false; //结尾字符串为true
    public $length = -1; //当$isEndingChar=true时 记录模式串长度
    public $fail; //失败指针
    public $children = []; //字符集只包含a~z这26个字符

    function __construct($data)
    {
        $this->data = $data;
        $this->fail = null;
        $i=0;
        while ($i < 26) {
            $this->children[$i] = null;
            $i++;
        }
    }
}


class AC_match
{
    public $root;

    function __construct()
    {
        $this->root = new AcNode(null);
    }

    public function insert($str)
    {
        $p = $this->root;
        $len = strlen($str);
        for ($i=0; $i<$len; $i++) {
            $index = ord($str[$i]) - ord('a');
            if ($p->children[$index] == null) {
                $newNode = new AcNode($str[$i]);
                $p->children[$index] = $newNode;
            }
            $p = $p->children[$index];
        }
        $p->length = $len;
        $p->is_ending_char = true;
    }

    public function buildFailurePointer()
    {
        $queue = new SplQueue();
        $root = $this->root;
        $root->fail = null;
        $queue->push($root);
        while (!$queue->isEmpty()) {
            $p = $queue->pop();
            for ($i=0; $i<26; $i++) {
                $pc = $p->children[$i];
                if ($pc ==null) {
                    continue;
                }
                if ($p == $root) {
                    $pc->fail = $root;
                } else {
                    $q = $p->fail;
                    while ($q != null) {
                        $qc = $q->children[ord($pc->data) - ord('a')];
                        if ($qc != null) {
                            $pc->fail = $qc;
                            break;
                        }
                        $q = $q->fail;
                    }

                    if ($q == null) {
                        $pc->fail = $root;
                    }
                }
                $queue->push($pc);
            }
        }
    }

    public function match($str)
    {
        $len = strlen($str);
        $p = $this->root;
        for ($i=0; $i<$len; $i++) {
            $idx = ord($str[$i]) - ord('a');
            while ($p->children[$idx] == null && $p != $this->root) {
                $p = $p->fail;
            }
            $p = $p->children[$idx];
            if ($p == null) {
                $p = $this->root;
            }

            $tmp = $p;
            while ($tmp != $this->root) {
                if ($tmp->isEndingChar == true) {
                    $pos = $i - $tmp->length + 1;
                    echo " 匹配起始下标 " .$pos ."; 长度" .$tmp->length;
                }
                $tmp = $tmp->fail;
            }
        }
    }
}

$ac = new AC_match();
$ac->insert('abcd');
$ac->insert('c');
$ac->insert('bc');
$ac->insert('bcd');

$ac->buildFailurePointer();
$ac->match('abcdefggfedcabcd');