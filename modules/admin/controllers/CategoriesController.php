<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Categories;
//use yii\web\Controller;
use app\components\Controller;

class CategoriesController extends Controller
{

    public function actionIndex()
    {
        $tree = Categories::getTree();
        return $this->render('index', ['tree' => $tree]);
    }

    public function actionAdd($id)
    {
        $category = (new Categories)->loadDefaultValues();
        $category->parent_category_id = $id;
        if ($category->load(Yii::$app->request->post()) && $category->validate()) {
            $res = $category->save();
            return $this->redirect('/admin/categories/edit/' . $category->category_id);
        } else {
            $parent_category = Categories::findOne($id);
            return $this->render('add', ['model' => $category, 'parent_category_id' => $id, 'name' => $parent_category['name'], 'type' => 'create']);
        }
    }

    public function actionDelete($id, $confirm = false)
    {
        if ($confirm) {
            $del = Categories::getDeleteList($id);
            Categories::deleteAll(['category_id' => $del]);
            return $this->redirect('/admin/categories');
        } else {
            $tree = Categories::getTree($id);
            $category = Categories::findOne($id);
            return $this->render('delete', ['model' => $category, 'tree' => $tree]);
        }
    }

    public function actionEdit($id)
    {
        $category = Categories::findOne($id);
        if ($category->load(Yii::$app->request->post()) && $category->validate()) {
            $results = $category->save();
            return $this->render('edit', ['model' => $category, 'type' => 'create', 'result' => $results]);
        } else {
            return $this->render('edit', ['model' => $category, 'type' => 'edit']);
        }
    }

}