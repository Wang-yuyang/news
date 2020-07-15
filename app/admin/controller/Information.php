<?php
/*
 * 信息中心维护 文章发布管理
 */

namespace app\admin\controller;
use think\Config;
use think\Request;
use think\Db;
use app\admin\model\Information as InformationModel;
use think\Session;
class Information extends Common {
	public function index() {
		return view('index');
	}

	public function welcome() {
		return view();
	}

	public function selectAll() {
		if (input('get.key')) {
			$InformationModel = new InformationModel();
			$count = $InformationModel -> count();
			$arr = $InformationModel -> getInformation(input("get.limit"), input("get.page"));
			
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

	public function update($id) {
		$id = $_REQUEST['id'];
		// echo $id;die();
		$request = Request::instance();
		$data = $request -> post();
		$informationmodel = new InformationModel();
		$result = $informationmodel -> updateData($data);
		return json(['code' => '1', 'msg' => '修改数据成功.']);
	}

	public function submit() {

		$informationmodel = new InformationModel();
		if ( request() -> isPost()) {

			$title = input("post.title");
			$content = input("post.content");
			//			$category1=input("post.category1");
			$category2 = input("post.select");
			$createtime = date('Y-m-d H:i:s');
			$created_by_user = Session::get('session_user');
			$languages = input("post.Languages");
			$country = input("post.Country");
			$keywords = input("post.Keywords");
			$data = ['title' => $title, 'content' => $content,
			//               'category1'=>$category1,//一级菜单ID
			'category2' => $category2, //二级菜单ID
			'created_by_time' => $createtime, 'created_by_user' => $created_by_user, 'Languages' => $languages, 'Country' => $country, 'keywords' => $keywords, ];

			$informationmodel -> add($data);
		};

		return json(['code' => '1', 'msg' => '添加数据成功.']);
	}

	/*
	 *删除功能
	 */
	public function del($id) {

		$informationmodel = new InformationModel();
		$result = $informationmodel -> del($id);

		return json(['code' => '1', 'msg' => '删除数据成功.']);
	}

	public function upload_img() {
		$informationmodel = new InformationModel();
		return $informationmodel -> lay_img_upload();
	}

	public function logout() {
		session(null);
		return view('Login/index');
	}

}
