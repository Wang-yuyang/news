<?php

namespace app\common\model;

use think\Model;

class Cate extends Model
{
    protected $autoWriteTimestamp = true;

    public function getNormalCategorys($field = "*")
    {
        // $where = [
        //     "status" => config("status.mysql.table_normal"),];
        $order = [
           
            "id" => "desc",
        ];
        $result = $this->field($field)
            ->order($order)
            ->select();

        return $result;
    }


}