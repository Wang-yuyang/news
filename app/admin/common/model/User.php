<?php

namespace app\admin\common\model;

use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;
    /*
     * 根据用户名获取数据库中的表数据
     */
    public function getAdminUserByUsername($username){
	
        if(empty($username)){
            return false;
        }
        $where=[
            "names"=>trim($username),
        ];
        $result = $this->where($where)->find();
		
        return $result;
    }
	public function getAdminUserByPassword($password){
	
	    if(empty($password)){
	        return false;
	    }
	    $where=[
	        "password"=>trim($password),
			
	    ];
	    $result = $this->where($where)->find();
		return $result;
	 
	}
    public function getUserByPhoneNumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return false;
        }
        $where = [
            "phone" => $phoneNumber,
        ];
        $result = $this->where($where)->find();
        return $result;
    }


    /**
     * 通过id获取用户信息
     * @param $id
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getUserById($id)
    {
        $id = intval($id);
        if (!$id) {
            return false;
        }
        return $this->find($id);

    }

    public function updataById($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }
        $where = [
            'id' => $id
        ];
        return $this->where($where)->save($data);

    }
}