<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Attributes;
use app\models\AttributesCategories;
use app\models\Categories;
use yii\helpers\ArrayHelper;

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
        $attribute = (new AttributesCategories)->loadDefaultValues();

        $attributes = AttributesCategories::find()
                ->joinWith('attributeinfo')
                ->where(['category_id' => $id])
                ->orderBy('product_attributes_categories.order')
                ->all();

        if ($attribute->load(Yii::$app->request->post()) && $attribute->validate()) {
            $res = $attribute->save();
            $order = ArrayHelper::map($attributes, 'attribute_id', 'order');
            if (count($order)) {
                AttributesCategories::updateAll(['order' => max($order) + 1], ['category_id' => $id, 'order' => 0]);
            } else {
                AttributesCategories::updateAll(['order' => 1], ['category_id' => $id, 'order' => 0]);
            }
            return $this->redirect(['/admin/attributes/list', 'id' => $id,]);
        } else {
            $category = Categories::findOne($id);

            return $this->render('list', ['category' => $category, 'attributes' => $attributes, 'model' => $attribute,]);
        }
    }

    public function actionDel($id, $cat)
    {
        // сделать удаление записей из таблицы AttributesList
        // для удаленного атрибута (attribute_id) он же $id
        // для всех товаров (product_id)
        // пренадлежащих категориии $cat
        if (AttributesCategories::deleteAll(['attribute_id' => $id, 'category_id' => $cat])) {
            return $this->redirect(['/admin/attributes/list', 'id' => $cat,]);
        }
    }

}
