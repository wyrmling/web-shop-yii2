<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Attributes;
use app\models\AttributesCategories;
//use app\models\AttributesList;
use app\models\Categories;

class AttributesController extends Controller
    {

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $attributes = (new Attributes)->loadDefaultValues();

        if ($attributes->load(Yii::$app->request->post()) && $attributes->validate()) {
            $res = $attributes->save();
            return $this->redirect('/admin/attributes/edit/' . $attributes->attribute_id);
        } else {
            return $this->render('create', ['model' => $attributes, 'type' => 'create']);
        }
    }

    public function actionEdit($id)
    {
        if (!empty($id)) {
            $attributes = Attributes::find()
                    ->where(['attribute_id' => $id])
                    ->one();

            if ($attributes->load(Yii::$app->request->post()) && $attributes->validate()) {
                $results = $attributes->save();
                return $this->render('edit', ['model' => $attributes, 'type' => 'create', 'result' => $results]);
            } else {
                return $this->render('edit', ['model' => $attributes, 'type' => 'edit']);
            }
        }
    }

    public function actionDelete($id)
    {
        if (Attributes::deleteAll(['attribute_id' => $id])) {
            return $this->redirect('/admin/attributes');
        }
    }

    public function actionList($id)
    {
        $category = Categories::findOne($id);
        $attributes = AttributesCategories::find()
                ->joinWith('attributeinfo')
                ->where(['category_id' => $id])
                ->orderBy('product_attributes_categories.order')
                ->all();
        return $this->render('list', ['category' => $category, 'attributes' => $attributes,]);
    }

    public function actionDel($id, $cat)
    {
        return $this->render('del', ['id' => $id, 'cat' => $cat]);
    }

    }
