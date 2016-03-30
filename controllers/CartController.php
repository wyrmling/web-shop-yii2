<?php

namespace app\controllers;

use Yii;
use app\components\Controller;
use app\models\Cart;
use app\models\Orders;
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
        $user = Yii::$app->user->identity;
        if (isset($user)) {
            $order->user_id = $user->getId();
        }
        if ($order->load(Yii::$app->request->post())
            && $order->validate()
            && Yii::$app->session->get('productsarray')
        ) {
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
        ]);
    }

    public function actionAdd($id)
    {
        Cart::addProduct((int) $id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete()
    {
        if (Yii::$app->request->isAjax) {
            Cart::DeleteProduct((int) Yii::$app->request->post('id'));
            echo json_encode(count(Yii::$app->session->get('productsarray')));
        } else {
            echo json_encode('nok');
        }
    }

}