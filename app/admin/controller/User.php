<?php
/*
 * 角色权限管理
 */

namespace app\admin\controller;
use think\Config;
use think\Request;
use app\admin\model\User as UserModel;
use think\Session;
class User extends Common {
	public function lst() {
		return view('index');
	}

	public function welcome() {
		//		return view();
		return view();
	}

	public function selectAll() {
		if (input('get.key')) {
			$usermodel = new UserModel();
			$count = $usermodel -> count();
			$arr = $usermodel -> getUser(input("get.limit"), input("get.page"));
			return json(['count' => $count, 'data' => $arr]);
		} else {
			return view();
		}
	}

	public function page() {
		return view('page');
	}

	public function add() {
		return view("add");
	}

	public function edit($id) {
		$id = $_REQUEST['id'];
		// $request = Request::instance();
		$res = UserModel::where('id', $id) -> find();
		$this -> assign("admin", $res);
		return view('edit');
	}

	public function update($id) {
		$id = $_REQUEST['id'];
		// echo $id;die();
		$request = Request::instance();
		$data = $request -> post();
		// dump($data);die();
		$user = new UserModel();
		$result = $user -> updateData($data);
	}

	public function submit() {
		$usermodel = new UserModel();
		if ( request() -> isPost()) {
			$remarks = input('remark');
			$names = input("post.names");
			$password = input("post.password");
			$role_id = input("post.role_id");
			$username = input("post.username");
			$Languages = input("post.Languages");
			$flag = "1";
			$remark = $remarks;
			//input("post.remark");
			$createtime = date('Y-m-d H:i:s');

			$data = ['names' => $names, 'password' => md5($password), 'role_id' => $role_id, 'username' => $username, 'Languages' => $Languages, 'flag' => $flag, 'Remarks' => $remark, 'createtime' => $createtime, ];
			$usermodel -> add($data);
		};
		return json(['code' => '1', 'msg' => '添加数据成功.']);
	}

	/*
	 *删除功能
	 */
	public function del($id) {
		$usermodel = new UserModel();
		$result = $usermodel -> del($id);

		return json(['code' => '1', 'msg' => '删除数据成功.']);
	} 

	public function upload_img() {
		$usermode = new UserModel();
		return $usermode -> lay_img_upload();
	}

	public function logout() {
		session(null);
		 $this->redirect('admin/login/index');
		 // return view('admin/login/index');
	}

}
