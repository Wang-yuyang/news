<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use think\Request;
class News extends Model {

	public function getInformation($limit = 10, $page = 1, $data = []) {

		return $this -> where($data) -> order('id', 'desc') -> limit(($page - 1) * $limit, $limit) -> select();

	}

	public function lay_img_upload() {

		$file = Request::instance() -> file('file');
		$info = $file -> move(ROOT_PATH . 'public' . DS . 'uploads');
	
		if ($info) {
			$name_path = str_replace('\\', "/", $info -> getSaveName());
			$result["location"] = "/uploads/" . $name_path;
			return json($result);
		}
		return $result['data']["src"];

		// return json_encode($result);

	}

}
?>