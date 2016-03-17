<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Categories;

class CategoriesController extends Controller
{

    public function actionIndex()
    {
        $tree = Categories::getTree();
        $quantities = Categories::getCategoriesList();
        return $this->render('index', ['tree' => $tree, 'quantities' => $quantities]);
    }

    public function actionAdd($id)
    {
        $category = (new Categories)->loadDefaultValues();
        if ($category->load(Yii::$app->request->post()) && $category->validate()) {
            $category->save();
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
            $tree = Categories::getTree();
            $category = Categories::findOne($id);
            $quantities = Categories::getCategoriesList();
            return $this->render('delete', ['model' => $category, 'tree' => $tree, 'quantities' => $quantities]);
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