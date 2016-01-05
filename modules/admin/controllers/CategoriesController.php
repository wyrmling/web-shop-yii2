<?php

namespace app\modules\admin\controllers;

use app\models\Categories;
//use yii\web\Controller;
use app\components\Controller;

class CategoriesController extends Controller
    {

    public function actionIndex()
    {
        $categories = Categories::find()
                ->asArray()
                ->orderBy('parent_category_id')
                ->all();
        $tree = Categories::form_tree($categories);
        return $this->render('index', ['categories' => $categories, 'tree' => $tree]);
    }

    public function actionAdd($id = 0)
    {
        if ($id == 0) {
            $category = null;
        } else {
            $category = Categories::findOne($id);
        }
        return $this->render('add', ['id' => $id, 'model' => $category]);
    }

    public function actionDelete($id = 0)
    {
        $category = Categories::findOne($id);
        return $this->render('delete', ['id' => $id, 'model' => $category]);
    }

    public function actionEdit($id = 0)
    {
        $category = Categories::findOne($id);
        return $this->render('edit', ['id' => $id, 'model' => $category]);
    }

    }
