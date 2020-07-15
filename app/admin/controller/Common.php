<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
//        if (!Session('session_user')) {
//            $this->error('没有登录系统', url('Login/index'));
//        }
    }
}
