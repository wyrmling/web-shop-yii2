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

}
