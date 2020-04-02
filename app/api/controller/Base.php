<?php
namespace app\api\controller;

use app\common\controller\BaseController;
use app\facade\ArticleModel;

class Base extends BaseController
{

    protected function initialize()
    {
        parent::initialize();

    }

    public function __call($name, $arguments)
    {
        return 'base error:'.$name;
    }

}