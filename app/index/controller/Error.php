<?php
namespace app\index\controller;

class Error extends Base
{
    public function __call($method, $args)
    {
        return 'error request!';
    }
    
}