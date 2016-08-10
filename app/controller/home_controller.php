<?php
namespace app\controller;
use yapf\Request;

class home_controller extends \app\authorized_controller
{
    public function index(Request $rq)
    {
        return $this->view();
    }
}