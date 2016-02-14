<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Categories;
//use app\models\Products;
use app\models\AttributesCategories;
use app\models\Products;
use Yii;

class ProductsController extends Controller
    {

    public function actionIndex($id)
    {

        $product = Yii::$app->db->createCommand(
                'SELECT * FROM products pr
                LEFT JOIN product_brands pr_b ON pr.brand_id = pr_b.brand_id
                WHERE product_id=:product_id AND status=:status')
                ->bindValue(':product_id', $_GET['id'])
                ->bindValue(':status', Products::VISIBLE)
                ->queryOne();

        $fullPach = Categories::findAll(Categories::getFullPath($product['category_id']));

        $attributes = Yii::$app->db->createCommand(
                'SELECT pr_a_c.attribute_id,
                        pr_a.attribute_name,
                        pr_a.unit,
                        pr_a_l.value
                FROM product_attributes_categories pr_a_c
                LEFT JOIN product_attributes pr_a ON pr_a_c.attribute_id = pr_a.attribute_id
                LEFT JOIN product_attributes_list pr_a_l ON pr_a_c.attribute_id = pr_a_l.attribute_id
                WHERE category_id=:category_id AND product_id=:product_id
                ORDER BY pr_a_c.order')
                ->bindValue(':product_id', $_GET['id'])
                ->bindValue(':category_id', $product['category_id'])
                ->queryAll();

        return $this->render('index', [
                    'product' => $product,
                    'fullPach' => $fullPach,
                    'attributes' => $attributes,
                        ]
        );
    }

    }
