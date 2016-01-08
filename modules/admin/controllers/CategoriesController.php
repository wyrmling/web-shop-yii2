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
        $categories = Categories::find()
                ->asArray()
                ->orderBy('parent_category_id')
                ->all();
        $tree = Categories::formTree($categories);
        return $this->render('index', ['categories' => $categories, 'tree' => $tree]);
    }

    public function actionAdd($id)
    {
        $category = (new Categories)->loadDefaultValues();
        if ($category->load(Yii::$app->request->post()) && $category->validate()) {
            $res = $category->save();
            return $this->redirect('/admin/categories/edit/' . $category->category_id);
        } else {
            $parent_category = Categories::findOne($id);
            return $this->render('add', ['model' => $category, 'parent_category_id' => $id, 'name' => $parent_category['name'], 'type' => 'create']);
        }
    }

    public function actionDelete($id)
    {
        if (!empty($id)) {
            $category = Categories::findOne($id);
            $categories = Categories::find()
                    ->asArray()
                    ->orderBy('parent_category_id')
                    ->all();
            $tree = Categories::formTree($categories);
            return $this->render('delete', ['model' => $category, 'categories' => $categories, 'tree' => $tree]);
        }
    }

    public function actionDeleted($id)
    {
        if (!empty($id)) {
            $categories = Categories::find()
                    ->asArray()
                    ->orderBy('parent_category_id')
                    ->all();
            $tree = Categories::formTree($categories);
            Categories::$array[] = $id;
            $array = Categories::buildArray($tree, $id);
            Categories::deleteAll(['category_id' => $array]);
            return $this->redirect('/admin/categories');
        }
    }

    public function actionEdit($id)
    {
        if (!empty($id)) {
            $category = Categories::findOne($id);
            if ($category->load(Yii::$app->request->post()) && $category->validate()) {
                $results = $category->save();
                return $this->render('edit', ['model' => $category, 'type' => 'create', 'result' => $results]);
            } else {
                return $this->render('edit', ['model' => $category, 'type' => 'edit']);
            }
        }
    }

}
