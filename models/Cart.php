<?php

namespace app\models;

use Yii;
use yii\base\Model;

/*
 * This is the model class for user cart
 * @propertys
 */

class Cart extends Model
{

    public static function countTotalSum($product)
    {
        $sum = 0;
        foreach (Yii::$app->session->get('productsarray') as $key => $value) {
            if (isset($product[$value]['special_price'])) {
                $sum += $product[$value]['special_price'];
            } else {
                $sum += $product[$value]['price'];
            }
        }
        return $sum;
    }

    public static function addProduct($product_id)
    {
        $session = Yii::$app->session;
        $products = $session->get('productsarray');
        $products[] = $product_id;
        $session->set('productsarray', $products);
    }

    public static function DeleteProduct($product_id)
    {
        $session = Yii::$app->session;
        $products = $session->get('productsarray');
        $key = array_search($product_id, $products);
        unset($_SESSION['productsarray'][$key]);
    }

    public static function DeleteSelectedProduct($product_id)
    {
        $selected_products_in_cart = Yii::$app->session->get('productsarray');
        foreach ($selected_products_in_cart as $key => $value) {
            if ($value == $product_id){
                unset($_SESSION['productsarray'][$key]);
            }
        }
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
                    $order_details->price = $products_from_cart[$key]['price'];
                } else {
                    $order_details->price = $products_from_cart[$key]['special_price'];
                }
                if ($order_details->validate()) {
                    $order_details->save();
                }
            }
        }
    }

}
