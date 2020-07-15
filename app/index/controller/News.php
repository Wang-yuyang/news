<?php

namespace app\index\controller;
use think\Config;
use think\Controller;
use app\index\model\News as NewsModel;
use think\Request;

class News extends  Controller
{
	public function index()
    {
	    /*
	     * Model：从news数据库中四条读取rec字段(是否推荐)为1的的id、title、pic(缩略图地址)数据
	     * controller：
	     *      将获取的数据pic和title渲染给index页面
	     *
	     */
		$articleM = new NewsModel();
		$recArt = $articleM -> getRecArt();
		$categorys = db('category') -> where(array('pid' => 0)) -> select();
		$this -> assign(array('categorys' => $categorys, 'recArt' => $recArt));
		return view();
	}
//  ======================== news首页几个窗口 ========================
/*
 * ajax请求，返回json数据
 */
//  工作动态 3
	public function workingTrends()
    {
//        header("Content-type: text/html; charset=utf-8");
        $newst = new NewsModel() ;
        $result = $newst->getTitle('3')->select();
        return show( '1' , 'ok!' , $result) ;
    }
//    通知公告 9
    public function notice()
    {
        $newst = new NewsModel() ;
        $result = $newst->getTitle('9')->select();
        return show( '1' , 'ok!' , $result) ;
    }
//    学术研究 4
    public function academicResearch()
    {
        $newst = new NewsModel() ;
        $result = $newst->getTitle('4')->select();
        return show( '1' , 'ok!' , $result) ;
    }
//    高层声音 5
    public function highLevelVoice()
    {
        $newst = new NewsModel() ;
        $result = $newst->getTitle('5')->select();
        return show( '1' , 'ok!' , $result) ;
    }
//    会员风采 6
    public function memberStyle()
    {
        $newst = new NewsModel() ;
        $result = $newst->getTitle('6')->select();
        return show( '1' , 'ok!' , $result) ;
    }
}
