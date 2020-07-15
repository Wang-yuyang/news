<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use think\Request;
use think\Session;
class Information extends Model {
	public function add($data) {

		if (empty($data) || !is_array($data)) {

			return false;
		}
		$res = $this -> save($data);

	}

	public function getInformation($limit = 10, $page = 1, $data = []) {
		if (Session::get('session_role_id') != 1) {
			return $this -> where("created_by_user", "=", Session::get('session_user')) -> order('id', 'desc') -> limit(($page - 1) * $limit, $limit) -> select();
		} else {
			return $this -> where($data) -> order('id', 'desc') -> limit(($page - 1) * $limit, $limit) -> select();
		}

	}

	//修改
	public function updateData($data) {

		$title = $data['title'];
		$content = $data['content'];
		$category2 = input("post.select");
		$createtime = date('Y-m-d H:i:s');
		$created_by_user = "admin";
		$languages = $data['Languages'];
		$country = $data['Country'];
		$keywords = $data['Keywords'];

		return $this -> update(['category2' => $category2, 'title' => $title, 'content' => $content, 'created_by_time' => $createtime, 'created_by_user' => $created_by_user, 'Country' => $country, 'Languages' => $languages, 'keywords' => $keywords], ['id' => $data['id']]);
	}

	public function del($id) {
		$res = $this -> destroy($id);
	}

	public function lay_img_upload() {

		$file = Request::instance() -> file('file');
		
		if (empty($file)) {
			$result["code"] = "1";
			$result["msg"] = "请选择图片";
			$result['data']["src"] = '';
		} else {
			// 移动到框架应用根目录/public/uploads/ 目录下
			// $new_filename =   date('YmdHis',time()).rand(100,1000);//新的文件名
			// $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'layui' . DS . date('Y') . DS . date('m-d'),md5(microtime(true)));
			$info = $file -> move(ROOT_PATH . 'public' . DS . 'uploads');
			if ($info) {

				$name_path = str_replace('\\', "/", $info -> getSaveName());
				//					echo $name_path; die();
				//成功上传后 获取上传信息
				//				$result['code'] = 0;
				//为了照顾到layui富文本编辑器的小脾气 所以此处必须要用0表示成功
				//$result['msg'] = '上传成功';
				$result["location"] = "/uploads/" . $name_path;
				//$result['data']['title'] = '';
				return json($result);
				// echo json_encode($result);exit();

			} else {
				// 上传失败获取错误信息
				$result["code"] = "2";
				$result["msg"] = "上传出错";
				$result['data']["src"] = '';
			}
		}
		echo $result['data']["src"];
		die();
		// return json_encode($result);

	}

}
?>