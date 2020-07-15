<?php
    namespace app\admin\business;

use app\admin\model\Cate as CategoryModel;

    class Cate
    {
        public $model = null;
    
        public function __construct()
        {
            $this->model = new CategoryModel();
        }
        public function getNormalCategorys()
        {
            $field = "id,catename,pid";
            $categorys = $this->model->getNormalCategorys($field);
            if (!$categorys) {
                return $categorys;
            }
            $categorys = $categorys->toArray();
            return $categorys;
        }
    }
