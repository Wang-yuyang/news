<?php
namespace app\index\controller;
use think\Controller;
/*
 * 该页面是创建一个公用的页导航栏，同时向模块渲染内容文字以及跳转链接
 */

class Common extends controller {
	public function index() {
		$categorys = Db::table('category') -> where(array('pid' => 0)) -> select();
		return view('index' , ['categorys' => $categorys]);
	}

}
?>