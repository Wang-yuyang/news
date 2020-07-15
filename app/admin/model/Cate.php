<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use think\Request;
class Cate extends Model{
	public function add($data){
		if(empty($data)|| !is_array($data)){
			return false;
		}
		$res=$this->save($data);
		
	}
	public function getCate($limit = 10, $page = 1,$data=[]){
		return $this->where($data)->order('id','desc')->limit(($page -1) *$limit, $limit)->select();
	}
	public function catetree($limit = 10, $page = 1,$data=[]){

		$cateres= $this->where($data)->limit(($page -1) *$limit, $limit)->select();
		return $this->sort($cateres);
	}
	public function sort($data,$pid=0,$level=0){
		static $arr=array();
		foreach($data as $k=>$v){
			if($v['pid']==$pid){
				$v['level']=$level;
				$arr[]=$v;
				$this->sort($data,$v['id'],$level+1);
			}
		}
		return $arr;
	}
}

?>