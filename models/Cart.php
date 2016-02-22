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

    public static function LoadOrderDetailsTable($products_from_cart)
    {
        $order_id = Yii::$app->db->getLastInsertID();
        $products_counter = array_count_values(Yii::$app->session->get('productsarray'));
        
        foreach (Yii::$app->session->get('productsarray') as $key => $value){
            $order_details = new OrderDetails();
            $order_details->order_id=$id;
            $order_details->product_id;
        }  
        
        $order_details->quantity;
        $order_details->status;
        $order_details->price;
        // SELECT * FROM orders WHERE id=LAST_INSERT_ID();
            // Yii::$app->db->getLastInsertID();
            // посчитать количества повторяющихся товаров array_count_values()
            // заполнить данными таблицу OrderDetails
    }

}
