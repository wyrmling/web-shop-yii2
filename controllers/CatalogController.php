<?php

namespace app\controllers;

//use yii\web\Controller;
use app\models\Categories;
use app\components\Controller;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $categories = Categories::find()
                ->where(['parent_category_id' => 0])
                // ->asArray()
                ->orderBy('name')
                ->all();
        return $this->render('index', ['categories' => $categories]);
    }

    public function actionCategory($id = 0)
    {
        $subcategories = Categories::find()
                ->where(['parent_category_id' => $id])
                //->asArray()
                ->orderBy('name')
                ->all();

        $fullPach = Categories::findAll(Categories::getFullPath($id));

        return $this->render('category', [
                    'subcategories' => $subcategories,
                    'fullPach' => $fullPach
                    ]);
    }

}
