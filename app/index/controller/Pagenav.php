<?php


namespace app\index\controller;

/*
 * 页渲染
 */

use app\index\model\Content;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\News ;

class Pagenav extends Controller
{
    public function index()
    {
        return view('index') ;
    }

//  列表页渲染
    public function listPage()
    {
//        第一步获取栏目的id
        $categoyId = input('cateid');
//        第二步获取该ID下的文章标题及其它信息-从conetnt表中
        $newst = new News() ;
        $newTitle = $newst->getTitle( $categoyId )->select();
        $this->assign('TitleAndTime' , $newTitle) ;

        return view('listpage') ;
    }
//  图片页渲染
    public function picturepage()
    {

    }
//  单页渲染
    public function singlePage()
    {

    }
//    渲染文章内容页面
    public function newsContent()
    {
        $contentId = input('contentid');
        $newst = new News() ;
        $content = $newst->getContent($contentId)->select() ;
//        $content = $content->toArray();
        $this->assign('content' , $content) ;
        return view('newsContent') ;
//        ：error=>未定义数组索引
//        dump($content);

//        return show( '1' , 'ok!' , $content) ;

    }

    public function newInformation()
//        跳转模块
    {
        $this->redirect('/index.php/admin/Information/');
    }

}   qwertyuiop[]\rrrrrrrrrrrrrrrr