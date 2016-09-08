<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use app\models\Cart;
use app\models\Orders;
use yii\helpers\ArrayHelper;

class CartController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }
    
    public function actionIndex()
    {
        if (Yii::$app->user->id) {
            $client_info = (new \yii\db\Query)
                ->select(['phone_number', 'first_name', 'last_name'])
                ->from('users')
                ->where(['user_id' => Yii::$app->user->id])
                ->one();
        } else {
            $client_info = null;
        }

        $products = (new \yii\db\Query)
            ->select(['product_id', 'title', 'brand_name', 'price', 'special_price'])
            ->from('products')
            ->leftJoin('product_brands', 'product_brands.brand_id = products.brand_id')
            ->where(['product_id' => Yii::$app->session->get('productsarray')])
            ->orderBy('title')
            ->all();
        $products = ArrayHelper::index($products, 'product_id');
        if ($products) {
            $total_sum = Cart::countTotalSum($products);
        } else {
            $total_sum = 0;
        }

        $order = new Orders;
        if (Yii::$app->user->id) {
            $order->user_id = Yii::$app->user->id;
        }
        if ($order->load(Yii::$app->request->post()) && $order->validate() && Yii::$app->session->get('productsarray'))
        {
            $res = $order->save();
            Cart::LoadOrderDetailsTable($products);
            Cart::DeleteAllProducts();
        } else {
            $res = false;
        }

        return $this->render('index', [
            'products' => $products,
            'order' => $order,
            'res' => $res,
            'total_sum' => $total_sum,
            'client_info' => $client_info,
        ]);
    }

    public function actionUpquantity()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ((int) Yii::$app->request->post('id') > 0) {
            Cart::addProduct((int) Yii::$app->request->post('id'));

            $products = (new \yii\db\Query)
                ->select(['product_id', 'price', 'special_price'])
                ->from('products')
                ->where(['product_id' => Yii::$app->session->get('productsarray')])
                ->orderBy('title')
                ->all();
            $products = ArrayHelper::index($products, 'product_id');
            $total_sum = Cart::countTotalSum($products);

            $product_quantity = array_count_values(Yii::$app->session->get('productsarray'));

            $items = [$product_quantity[(int) Yii::$app->request->post('id')], count(Yii::$app->session->get('productsarray')), $total_sum];
        } else {
            $items = ['nok'];
        }
        return $items;
    }

    public function actionDownquantity()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ((int) Yii::$app->request->post('id') > 0) {
            Cart::DeleteProduct((int) Yii::$app->request->post('id'));

            $products = (new \yii\db\Query)
                ->select(['product_id', 'price', 'special_price'])
                ->from('products')
                ->where(['product_id' => Yii::$app->session->get('productsarray')])
                ->orderBy('title')
                ->all();
            $products = ArrayHelper::index($products, 'product_id');
            $total_sum = Cart::countTotalSum($products);

            $product_quantity = array_count_values(Yii::$app->session->get('productsarray'));

            if (isset($product_quantity[(int) Yii::$app->request->post('id')])) {
                $product_counter = $product_quantity[(int) Yii::$app->request->post('id')];
            } else {
                $product_counter = 0;
            }
            $items = [$product_counter, count(Yii::$app->session->get('productsarray')), $total_sum];
        } else {
            $items = ['nok'];
        }
        return $items;
    }

    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ((int) Yii::$app->request->post('id') > 0) {
            Cart::DeleteSelectedProduct((int) Yii::$app->request->post('id'));

            $products = (new \yii\db\Query)
                ->select(['product_id', 'price', 'special_price'])
                ->from('products')
                ->where(['product_id' => Yii::$app->session->get('productsarray')])
                ->orderBy('title')
                ->all();
            $products = ArrayHelper::index($products, 'product_id');
            $total_sum = Cart::countTotalSum($products);

            $items = [count(Yii::$app->session->get('productsarray')), $total_sum];
        } else {
            $items = ['nok'];
        }
        return $items;
    }

}