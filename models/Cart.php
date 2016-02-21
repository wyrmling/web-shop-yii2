<?php

namespace app\models;

use yii\base\Model;
use Yii;

/*
 * This is the model class for user cart
 * @propertys
 */

class Cart extends Model
{

    public static function addProduct($product_id)
    {
        $session = Yii::$app->session;
        $products = $session->get('productsarray');
        $products[] = $product_id;
        $session->set('productsarray', $products);
    }

    public static function DeleteProduct($product_id)
    {
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }
        unset($_SESSION['productsarray'][$product_id]);
    }

     public static function DeleteAllProducts()
    {
        if (!Yii::$app->session->isActive) {
            Yii::$app->session->open();
        }
        unset($_SESSION['productsarray']);
    }
}
