<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Categories;
use app\models\Products;

class ProductsController extends Controller
{

    public function actionIndex($id)
    {
        $product = Products::find()
                ->where(['product_id' => $id, 'status' => 1])
                ->one();
        
        $fullPach = Categories::findAll(Categories::getFullPath($product->category_id));

        return $this->render('index', [
                    'product' => $product,
                    'fullPach' => $fullPach,
                        ]
        );
    }

}
