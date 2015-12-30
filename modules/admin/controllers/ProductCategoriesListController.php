<?php

namespace app\modules\admin\controllers;

use app\models\ProductCategoriesList;

class ProductCategoriesListController extends \yii\web\Controller
    {

    public function actionIndex()
    {
        $categories = ProductCategoriesList::find()
                ->asArray()
                ->all();
        return $this->render('index', ['categories' => $categories]);
    }

    }
