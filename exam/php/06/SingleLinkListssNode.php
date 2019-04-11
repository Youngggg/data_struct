<?php
/**
 * Created by PhpStorm.
 * User: yangfan
 * Date: 2019-02-20
 * Time: 11:33
 */

class SingleLinkListssNode
{
    public $data;

    public $next;

    public function __construct($data = null)
    {
        $this->data = $data;
        $this->next = null;
    }
}