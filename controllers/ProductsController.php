<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Categories;
//use app\models\Products;
use app\models\AttributesCategories;
use Yii;

class ProductsController extends Controller
    {

    public function actionIndex($id)
    {

        $product = Yii::$app->db->createCommand('SELECT * FROM products
                                                LEFT JOIN product_brands ON products.brand_id = product_brands.brand_id
                                                WHERE product_id=:product_id AND status=:status')
                ->bindValue(':product_id', $_GET['id'])
                ->bindValue(':status', 1)
                ->queryAll();

//$product = Products::find()
        //        ->where(['product_id' => $id, 'status' => 1])
        //        ->one();

        $fullPach = Categories::findAll(Categories::getFullPath($product[0]['category_id']));

        $attributes = Yii::$app->db->createCommand('SELECT product_attributes_categories.attribute_id,
                                                           product_attributes.attribute_name,
                                                           product_attributes.unit,
                                                           product_attributes_list.value
                                                    FROM product_attributes_categories
                                                    LEFT JOIN product_attributes
                                                            ON product_attributes_categories.attribute_id = product_attributes.attribute_id
                                                    LEFT JOIN product_attributes_list
                                                            ON product_attributes_categories.attribute_id = product_attributes_list.attribute_id
                                                    WHERE category_id=:category_id AND product_id=:product_id
                                                    ORDER BY product_attributes_categories.order')
                ->bindValue(':product_id', $_GET['id'])
                ->bindValue(':category_id', $product[0]['category_id'])
                ->queryAll();

        $att = AttributesCategories::find()
                ->joinWith('attributename')
                ->where(['category_id' => $product[0]['category_id']])
                ->orderBy('product_attributes_categories.order')
                ->all();

        return $this->render('index', [
                    'product' => $product,
                    'fullPach' => $fullPach,
                    'att' => $att,
            'attributes' => $attributes,
                        ]
        );
    }

    }
