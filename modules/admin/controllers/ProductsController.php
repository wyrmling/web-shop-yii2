<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Products;
use app\models\Categories;
use yii\helpers\ArrayHelper;

class ProductsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $products = (new Products)->loadDefaultValues();

        if ($products->load(Yii::$app->request->post()) && $products->validate()) {
            $res = $products->save();
            $productParams = ArrayHelper::toArray($products);

            if ($productParams['status'] == Products::VISIBLE) {
                Categories::setCategoriesCounters($productParams['category_id'], 1, 0);
            }
            if ($productParams['status'] == Products::HIDDEN) {
                Categories::setCategoriesCounters($productParams['category_id'], 0, 1);
            }
            return $this->redirect('/admin/products/edit/' . $products->product_id);
        } else {
            return $this->render('add', ['model' => $products, 'type' => 'add']);
        }
    }

    public function actionEdit($id)
    {
        $products = Products::find()
            ->where(['product_id' => $id])
            ->one();
        $productOldParams = ArrayHelper::toArray($products);

        if ($products->load(Yii::$app->request->post()) && $products->validate()) {
            $results = $products->save();
            $productParams = ArrayHelper::toArray($products);

            if ($productParams['status'] == Products::VISIBLE
                    && (int) $productParams['status'] != (int) $productOldParams['status']) {
                Categories::setCategoriesCounters($productParams['category_id'], 1, -1);
            }
            if ($productParams['status'] == Products::HIDDEN
                    && (int) $productParams['status'] != (int) $productOldParams['status']) {
                Categories::setCategoriesCounters($productParams['category_id'], -1, 1);
            }
            if ((int) $productParams['category_id'] != (int) $productOldParams['category_id']
                    && $productParams['status'] == Products::VISIBLE) {
                Categories::setCategoriesCounters($productOldParams['category_id'], -1, 0);
                Categories::setCategoriesCounters($productParams['category_id'], 1, 0);
            }
            if ((int) $productParams['category_id'] != (int) $productOldParams['category_id']
                    && $productParams['status'] == Products::HIDDEN) {
                Categories::setCategoriesCounters($productOldParams['category_id'], 0, -1);
                Categories::setCategoriesCounters($productParams['category_id'], 0, 1);
            }
            return $this->render('edit', ['model' => $products, 'type' => 'edit', 'result' => $results]);
        } else {
            return $this->render('edit', ['model' => $products, 'type' => 'create']);
        }
    }

    public function actionDelete($id)
    {
        $productParams = Products::find()
                ->where(['product_id' => $id])
                ->asArray()
                ->one();

        if (Products::deleteAll(['product_id' => $id])) {

            if ($productParams['status'] == Products::VISIBLE) {
                Categories::setCategoriesCounters($productParams['category_id'], -1, 0);
            }
            if ($productParams['status'] == Products::HIDDEN) {
                Categories::setCategoriesCounters($productParams['category_id'], 0, -1);
            }
            return $this->redirect('/admin/products');
        }
    }

}
