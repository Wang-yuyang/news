<?php


namespace app\index\model;


use think\Model;

class Category extends Model
{
//    过去请求ID的文章type
    public function getCategoryType( $categoryid )
    {
        $result = $this->where('id' , $categoryid)->value('type') ;
        return $result ;
    }
}