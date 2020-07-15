<?php
namespace app\admin\business;
use app\admin\common\model\User as UserModel;
use think\Session;
class User
{
    public function login($data)
    {
		$adminUserObj = new UserModel();
		//判断用户名是否存在
		
        $adminUser = $adminUserObj->getAdminUserByUsername($data['names']);
		
        if (!$adminUser) {
			return '用户名不存在.';
			
        }
		//判断密码是否正确
		        if ($adminUser["password"] != md5($data['password'])) {
		        return '密码不正确.';
		        }
				 //记录sessiion
				 Session::set('session_user',$adminUser['username']);//获取姓名
				  Session::set('session_role_id',$adminUser['role_id']);//获取该用户角色编号1:管理员2:发布员
				 // $activeUser=JSON.parse(localStorage.getItem($adminUser['username']));
				
				 if(Session::has('session_user')){
					 Session::get('session_user');
				 }
				return '登录成功';      
   }

    public function getUserByUsername($username)
    {
		$adminUserObj = new UserModel();
        $adminUser = $adminUserObj->getAdminUserByUsername($username);
        if (empty($adminUser) || $adminUser->status != config("status.mysql.table_normal")) {
            return [];
        }
        $adminUser = $adminUser->toArray();
        return $adminUser;
    }
}