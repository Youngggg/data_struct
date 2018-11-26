<?php

#二叉查找树实现

#节点
class Node {
    public $key = null;
    public $parent = null;
    public $left = null;
    public $right = null;
}

#查找操作
function search($root, $k) {
    $cnode = $root;
    while ($cnode != null) {
	if ($cnode->key == $k) {
	    return $cnode;
	} elseif ($cnode->key > $key) {
	    $cnode = $cnode->left;
	} else {
	    $cnode = $cnode->right;
	}
    }
    return $cnode; 
}

#插入节点
function insert($root, $inode) {
    $cnode = $root;
    $pnode = null;
    while ($cnode != null) {
	$pnode = $code;
	if ($cnode->key > $inode->key) {
	    $cnode = $cnode->left;
	} else {
	    $cnode = $cnode->right;
	} 
    }

    $inode->parent = $pnode;
    if ($pnode === null) { #pnode == null,说明是空树
	$root = $inode;
    } else {
	if($pnode->key > $inode->key) {
	    $pnode->left = $inode;
	} else {
	    $pnode->right = $inode;
	}
    }
}

#查找最大关键字
function search_max($root) {
    $cnode = $root;
    while ($cnode->right != null) {
        $cnode = $cnode->right;
    }
    return $cnode;
}

#查找最小关键字
function search_min($root) {
    $cnode = $root;
    while ($cnode->left != null) {
	$cnode = $cnode->left;
    }
    return $cnode;
}

#查找中序遍历的后继结点
function successor($x) {
    if ($x->right !== null) {
    	return search_min($x->right);
    }

    $p = $x->parent;
    while ($p !== null && $x = $p->right) {
	$x = $p;
	$p = $p->parent;
    } 
    return $p;
}

#删除结点
function delete($root, $dnode) {
    if ($dnode->left === null || $dnode->right === null) {
        $c = $dnode;
    } else {
	$c = successor($dnode);
    }

    if ($c->left !== null) {
	$s = $c->left;
    } else {
	$s = $c->right;
    }

    #将c的子节点的父母结点置为c的父母结点，此处c只可能有1个子节点，因为如果c有两个子节点，则c不可能是dnode的直接后继
    if ($s !== null) { 
	$s->parent = $c->parent;
    }

    #如果c的父母为空，说明c=dnode是根节点，删除根节点后直接将根节点置为根节点的子节点，此处dnode是根节点，且拥有两个子节点，则c是dnode的后继结点，c的父母就不会为空，就不会进入这个if
    if ($c->parent === null) {
	$root = $s;
    #如果c是其父节点的左右子节点，则将c父母的左右子节点置为c的左右子节点
    } elseif ($c == $c->parent->left) { 
    	$c->parent->left = $s;
    } else {
	$c->parent->right = $s;
    }

    #如果c!=dnode，说明c是dnode的后继结点，交换c和dnode的key值
    if ($c != $dnode) { 
   	$dnode->key = $c->key;
    }

    #返回根节点
    return $root;
}

#使用数组构造二叉查找树
function build_iterative_tree($arr) {
    $root = new Node();
    $root->key = $arr[0];
    for ($i = 1; $i < count($arr); $i++) { 
    	$new_node = new Node();
	$new_node->key = $arr[$i];
   	insert($root, $new_node);
    }

    return $root;
}

