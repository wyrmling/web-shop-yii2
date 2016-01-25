<?php

namespace app\controllers;

//use yii\web\Controller;
use app\models\Categories;
use app\models\Products;
use app\components\Controller;
use yii\data\Pagination;

class CatalogController extends Controller
{

    public function actionIndex()
    {
        $categories = Categories::find()
                ->where(['parent_category_id' => 0])
                ->orderBy('name')
                ->all();
        return $this->render('index', ['categories' => $categories]);
    }

    public function actionCategory($id = 0)
    {
        $subcategories = Categories::find()
                ->where(['parent_category_id' => $id])
                ->orderBy('name')
                ->all();

        $fullPach = Categories::findAll(Categories::getFullPath($id));

        $query = Products::find()
                //->select('products.*, product_brands.brand_name')
                //->with('brand')
                //->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
                ->where(['category_id' => $id, 'status' => 1]);

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $products = $query
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy('title')
                ->all();

        return $this->render('category', [
                    'subcategories' => $subcategories,
                    'fullPach' => $fullPach,
                    'products' => $products,
                    'pagination' => $pagination,
                        ]
        );
    }

}
