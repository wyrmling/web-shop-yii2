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
        $products_counter = Yii::$app->session->get('productsarray');
        if (isset($products_counter)) {
            $products_counter = array_count_values($products_counter);
            foreach ($products_counter as $key => $value) {
                $order_details = new OrderDetails();
                $order_details->order_id = $order_id;
                $order_details->product_id = $key;
                $order_details->quantity = $value;
                $order_details->status = \app\models\OrderDetails::DEFAULT_STATUS;
                if (empty($products_from_cart[$key]['special_price'])) {
                    $order_details->price = $products_from_cart[$key]['price'] * $value;
                } else {
                    $order_details->price = $products_from_cart[$key]['special_price'] * $value;
                }
                if ($order_details->validate()) {
                    $order_details->save();
                }
            }
        }
    }

}
