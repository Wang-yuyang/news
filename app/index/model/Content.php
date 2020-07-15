<?php


namespace app\index\model;


use think\Model;

class Content extends Model
{
//    获取文章的标题、正文、时间、发布人等信息
    public function getTitleContent($id)
    {
        $result = $this
            ->where('category_id' , $id)
            ->field('title , created_by_time')
            ->select() ;

        return $result ;
    }



    public function getCreated_by_timeAttr($value ,$data)
    {
        $result = strtotime($data['created_by_time']);
        $result = date("Y-m-d" , $result);
        return $result;
    }
}