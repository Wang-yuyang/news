<?php
/*
 * 信息中心页面page
 */


namespace app\index\controller;
use think\Config;
use think\Controller;
use app\index\model\Page as PageModel;
class Page extends  Controller {
	public function menu(){
		$categorys = db('category') -> where('id>=10 and type=1') -> select();
			
		foreach($categorys as $k=>$v){
			$childrend=db('category')->where(array('pid'=>$v['id']))->select();
			if($childrend){
				$categorys[$k]['childrend']=$childrend;
			}
			else{
				$categorys[$k]['childrend']=0;
			}
		}
		$value2=array("homeInfo"=>[
					"title"=>"首页2",
			"href"=>""
			]);
			$value3=array("logoInfo"=> [
				"title"=>"管理平台2",
				"image"=>"",
				"href"=>""
			]);
		$value1=array("menuInfo"=>$categorys);
		$value=array_merge($value2,$value3,$value1);
		// dump($value);
		return json($value);
		}
	public function index() {
		$categorys = db('category') -> where('id>=10 and type=1') -> select();
	
		foreach($categorys as $k=>$v){
			$childrend=db('category')->where(array('pid'=>$v['id']))->select();
			if($childrend){
				$categorys[$k]['childrend']=$childrend;
			}
			else{
				$categorys[$k]['childrend']=0;
			}
		}
		 // dump($categorys);die;
		$this -> assign('categorys' , $categorys);
		return view();
	}
	public function page(){
		
	}

}