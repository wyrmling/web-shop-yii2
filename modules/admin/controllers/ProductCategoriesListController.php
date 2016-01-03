<?php

namespace app\modules\admin\controllers;

use app\models\ProductCategoriesList;
//use yii\web\Controller;
use app\components\Controller;

class ProductCategoriesListController extends Controller
{

    public function actionIndex()
    {
        $categories = ProductCategoriesList::find()
                ->asArray()
                ->orderBy('parent_category_id')
                ->all();
        $tree = ProductCategoriesList::form_tree($categories);

        if (is_array($tree)) {
            return $this->render('index',
                    ['categories' => $categories,
                        'tree' => $tree]);
        } else {
            return false;
        }
    }

}
