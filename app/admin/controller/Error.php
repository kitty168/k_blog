<?php
namespace app\admin\controller;

class Error extends Base
{
    public function __call($method, $args)
    {
        return 'error request!';
    }
    
}