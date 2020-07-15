<?php
/*
 * 栏目管理
 */

namespace app\admin\Controller;

use think\Config;
use think\Request;
use app\admin\model\Cate as CateModel;
use app\admin\controller\Common;
use think\Db;

class Cate extends Common
{
    // public function index(){
    // 	 $catemodel=new CateModel();
    // 	$cateres=$catemodel->select();
    // 	// halt($cateres);die();
    // 	$this->assign("cateres", $cateres);
    // 	 return $this->fetch("", [
    // 	            'cateres' => json_encode($cateres),
    // 	        ]);
    // }
    public function selectAll()
    {
      
            $catemodel=new CateModel();
            $count=$catemodel->count();
            $arr=$catemodel->catetree(input("get.limit"), input("get.page"));
			$code="0";
            return  json(['count'=>0,'msg'=>'','code'=>0,'data'=>$arr]);
       
    }
   

    public function page()
    {
        return view("page");
    }
    public function add()
    {
		
        $catemodel=new CateModel();
        if (request()->isPost()) {
            $pid = input('post.pid');
            $catename=input("post.catename");
            $type=input("post.type");
            $data=[
                    'pid'=>$pid,
                    'name'=>$catename,
                    'type'=>$type,
                ];
            $catemodel->add($data);
            //=Db::table("cate")->column('catename');
        
            return json(['code'=>'1','msg'=>'添加数据成功.']);
        }
        $cateres=$catemodel->select();
    
        $this->assign("cateres", $cateres);
        return $this->fetch("", [
                    'cateres' => json_encode($cateres),
                ]);
    }
    public function submit()
    {
        $catemodel=new CateModel();
        if (request()->isPost()) {
            $pid = input('post.pid');
            $catename=input("post.catename");
            $type=input("post.type");
            $data=[
                    'pid'=>$pid,
                    'catename'=>$catename,
                    'type'=>$type,
                ];
            $catemodel->add($data);
        };
        return json(['code'=>'1','msg'=>'添加数据成功.']);
    }
	
	public function edit(){
		$id=input('post.');
		dump($id);
		
	}
}
