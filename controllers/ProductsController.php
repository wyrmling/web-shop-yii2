<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Categories;
use app\models\Products;
use app\models\AttributesCategories;

class ProductsController extends Controller
{

    public function actionIndex($id)
    {
        $product = Products::find()
                ->where(['product_id' => $id, 'status' => 1])
                ->one();

        $fullPach = Categories::findAll(Categories::getFullPath($product->category_id));

        $att = AttributesCategories::find()
                ->joinWith('attributename')
                ->where(['category_id' => $product->category_id])
                ->orderBy('product_attributes_categories.order')
                ->all();

        return $this->render('index', [
                    'product' => $product,
                    'fullPach' => $fullPach,
                    'att' => $att,
                        ]
        );
    }

}
