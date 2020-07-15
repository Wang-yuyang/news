<?php
namespace app\index\model;
use think\Model;
class News extends  Model
{
//  从news数据库中四条读取rec字段(是否推荐)为1的的id、title、pic(缩略图地址)数据  - 主要运用轮播图
	public function getRecArt() {
		$recArt = $this
            ->where('rec', '=', 1)
            ->field('id,title,pic')
            ->limit(4)-> select();
		return $recArt;
	}

	public function getTitle($id) {
	    $result = $this
            ->where('categid' , $id)
            ->field('id , title , pic , createtime');

	    return $result ;
    }
//    获取所有数据，用于渲染文章内容页
    public function getContent( $id )
    {
        $result = $this
            ->where('id' , $id)
            ->field('id , title , content , keywords , author , pic , createtime');

        return $result ;
    }
}
?>