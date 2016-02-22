<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Orders;
use app\models\OrderDetails;
use app\components\Controller;
use Yii;
use yii\helpers\ArrayHelper;

class CartController extends Controller
    {

    public function actionIndex()
    {
        $products = (new \yii\db\Query())
                ->select(['product_id', 'title', 'brand_name', 'price', 'special_price'])
                ->from('products')
                ->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
                ->where(['product_id' => Yii::$app->session->get('productsarray')])
                ->orderBy('title')
                ->all();
        $products = ArrayHelper::index($products, 'product_id');

        $order = new Orders();
        if ($order->load(Yii::$app->request->post()) && $order->validate()) {
            $res = $order->save();
            Cart::DeleteAllProducts();
            // Cart::LoadOrderDetailsTable($products);
            // SELECT * FROM orders WHERE id=LAST_INSERT_ID();
            // Yii::$app->db->getLastInsertID();
            // посчитать количества повторяющихся товаров array_count_values()
            // заполнить данными таблицу OrderDetails
        } else {
            $res = false;
        }

        return $this->render('index', [
                    'products' => $products,
                    'order' => $order,
                    'res' => $res,
        ]);
    }

    public function actionAdd($id)
    {
        Cart::addProduct((int) $id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        Cart::DeleteProduct((int) $id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    }
