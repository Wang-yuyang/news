<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use think\Request;
class User extends Model{
	public function add($data){
		if(empty($data)|| !is_array($data)){
			return false;
		}
		$res=$this->save($data);
		
	}
	public function getUser($limit = 10, $page = 1,$data=[]){
		return $this->where($data)->order('id','desc')->limit(($page -1) *$limit, $limit)->select();
	}
	//修改
	public function updateData($data)
	{
		$password=\md5($data['password']);
		$remarks=$data['remarks'];
		$role_id=$data['role_id'];
		$createtime=date('Y-m-d H:i:s');
		$Languages=$data['Languages'];
		return $this->update(['password'=>$password,'createtime'=>$createtime,'Remarks'=>$remarks,'Languages'=>$Languages,'role_id'=>$role_id],['id'=>$data['id']]);
	}
	public function del($id){
		$res = $this->destroy($id);
	}
	public function lay_img_upload()
	{
		
		   $file = Request::instance()->file('file');
		   if(empty($file)){
		   $result["code"] = "1";
		   $result["msg"] = "请选择图片";
		   $result['data']["src"] = '';
		           }else{
		   // 移动到框架应用根目录/public/uploads/ 目录下
		 // $new_filename =   date('YmdHis',time()).rand(100,1000);//新的文件名
		   // $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'layui' . DS . date('Y') . DS . date('m-d'),md5(microtime(true)));
		   $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/layui' );
		   if($info){
			
		   $name_path =str_replace('\\',"/",$info->getSaveName());
		  
		   //成功上传后 获取上传信息
		  $result['code']  =  0;  //为了照顾到layui富文本编辑器的小脾气 所以此处必须要用0表示成功
		                  $result['msg']   =  '上传成功';
		                  $result['data']['src'] =  "/uploads/layui/".$name_path;
		                  $result['data']['title'] = '';
						  return json(['code' => 0,'msg' => '上传成功', 'data'=> $result['data']['src']]);
		                   // echo json_encode($result);exit();
		   
		               }else{
		   // 上传失败获取错误信息
		   $result["code"] = "2";
		   $result["msg"] = "上传出错";
		   $result['data']["src"] ='';
		               }
		           }
				   echo $result['data']["src"];die();
		   // return json_encode($result);
		   
	}
	
}

?>