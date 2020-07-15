<?php
/*
 * 新闻管理栏功能
 */


namespace app\admin\controller;
use think\Config;
use think\Request;
use app\admin\model\News as NewsModel;
use think\Session;
class News extends Common {
	public function index() {
		return view();
	}

	public function selectAll() {
		if (input('get.key')) {
			$newsmodel = new NewsModel();
			$count = $newsmodel -> count();
			$arr = $newsmodel -> getInformation(input("get.limit"), input("get.page"));

			return json(['count' => $count, 'data' => $arr]);
		} else {
			return view();
		}
	}

	public function add() {
		if ( request() -> isPost()) {
			$newsmodel = new NewsModel();
			$data['categid'] = input('post.categid');
			$data['keywords'] = input('post.keywords');
			$data['title'] = input('post.title');
			$data['content'] = input('post.content');
			$data['pic'] = input('post.imgsrc');
			$data['createtime'] = date('Y-m-d H:i:s');
			$data['rec'] =input('post.rec');
			$data['author'] = Session::get('session_user');
			if ($newsmodel -> save($data)) {
				$this -> success('添加文章成功', url('index'));
			} else {
				$this -> error('添加文章失败');
			}
			return;

		}
		return view();
	}

	public function edit() {
		return view();
	}

	public function upload_img() {
		$newsmodel = new NewsModel();
		return $newsmodel -> lay_img_upload();
	}

}
