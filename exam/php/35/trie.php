<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-03-27
 * Time: 10:18
 */

class TrieNode
{
    public $data = null;
    public $children = [];
    public $is_ending_char = false;

    function __construct($data = null)
    {
        $this->data = $data;
        $i = 0;
        while ($i<26) {
            $this->children[] = null;
            $i++;
        }
    }
}

class Trie
{
    public $root;

    function __construct()
    {
        $this->root = new TrieNode('/');
    }

    public function insert($str)
    {
        $p = $this->root;
        $len = strlen($str);
        for ($i=0; $i<$len; $i++) {
            $index = ord($str[$i]) - ord('a');
            if ($p->children[$index] == null) {
                $newNode = new TrieNode($str[$i]);
                $p->children[$index] = $newNode;
            }
            $p = $p->children[$index];
        }
        $p->is_ending_char = true;
    }

    public function find($str)
    {
        $p = $this->root;
        for ($i=0; $i<strlen($str); $i++) {
            $index = ord($str[$i]) - ord('a');
            if ($p->children[$index] == null) {
                return false;
            }
            $p = $p->children[$index];
        }
        if ($p->is_ending_char == false) {
            return false;
        }
        return true;
    }
}

$trie = new Trie();
$trie->insert('test');
$trie->insert('testing');
$trie->insert('tested');


var_dump($trie->find('tested'));
var_dump($trie->root);