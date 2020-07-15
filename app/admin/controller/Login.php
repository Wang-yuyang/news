<?php
/*
 * 登录验证功能
 */

namespace app\admin\controller;
use think\Config;
use think\Controller;
use app\admin\validate\AdminUser;
use think\Session;
class Login extends  Controller {
	public function index() {
		return view('index');
	}

	 public function check()
	    {
	        //判断请求方式
	        if (!$this->request->isPost()) {
	            return show(config("status.error"), "请求方式不正确");
	        }
	        //参数验校
	        $username = request()->param("names");
	        $password = request()->param("password");
	        $captcha = request()->param("captcha");
	        return ($username); die;
	        $data = [
	            "names" => $username,
	            "password" => $password,
	            "captcha" => $captcha
	        ];
//	        return ($data) ; die;
//	        $validate = new AdminUser();
//
//	        if (!$validate->check($data)) {
//				$msg=$validate->getError();
//	            return json(['code'=>0,'msg'=>$msg]);
//	        }
	
	        try {
	            $adminUserObj = new \app\admin\business\User();
	            $result = $adminUserObj->login($data);
//				if( Session::get('session_role_id')==1){
				if( true ){
					 return json(['result'=>'登录成功','code'=>1,'msg'=>$result]);
				}
				else{
					 return json(['result'=>'登录成功','code'=>2,'msg'=>$result]);
				}

	        } catch (Exception $e) {
				 return json(['msg'=>$e->getMessage()]);
	           
	        }
	 
	    }
		

}
