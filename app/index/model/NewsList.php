<?php
namespace app\index\model;
use think\Model;
class NewsList extends  Model {
	public function getRecArt() {
		$recArt = $this -> where('rec', '=', 1)->field('id,title,pic')->limit(4)-> select();
		return $recArt;
	}

}
?>