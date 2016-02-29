<?php

namespace app\modules\admin\controllers;

use app\models\Orders;
use app\models\OrderDetails;
use Yii;

class OrdersController extends \yii\web\Controller
    {

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete($id)
    {
        if (Orders::deleteAll(['order_id' => $id]))
            return $this->redirect('/admin/orders');
    }

    public function actionPlus($id, $product_id)
    {
        $order = Orders::find()
                ->where(['order_id' => $id])
                ->one();

        $order_details = OrderDetails::find()
                ->where(['order_id' => $id, 'product_id' => $product_id,])
                ->one();

        Yii::$app->db->createCommand()
                ->update('order_details', ['quantity' => $order_details->quantity + 1], "order_id = $id AND product_id = $product_id")
                ->execute();

        Yii::$app->db->createCommand()
                ->update('orders', ['total_sum' => $order->total_sum + $order_details->price], "order_id = $id")
                ->execute();

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionMinus($id, $product_id)
    {
        $order = Orders::find()
                ->where(['order_id' => $id])
                ->one();

        $order_details = OrderDetails::find()
                ->where(['order_id' => $id, 'product_id' => $product_id,])
                ->one();

        if ($order_details->quantity > 1) {
            Yii::$app->db->createCommand()
                    ->update('order_details', ['quantity' => $order_details->quantity - 1], "order_id = $id AND product_id = $product_id")
                    ->execute();

            Yii::$app->db->createCommand()
                    ->update('orders', ['total_sum' => $order->total_sum - $order_details->price], "order_id = $id")
                    ->execute();
        }

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionView($id)
    {

        $order = Orders::find()
                ->where(['order_id' => $id])
                ->one();

        $order_details = OrderDetails::find()
                ->where(['order_id' => $id])
                ->all();

        return $this->render('view', [
                    'order' => $order,
                    'order_details' => $order_details,
        ]);
    }

    public function actionEdit($id)
    {

        $order = Orders::find()
                ->where(['order_id' => $id])
                ->one();

        $order_details = OrderDetails::find()
                ->where(['order_id' => $id])
                ->all();

        return $this->render('edit', [
                    'order' => $order,
                    'order_details' => $order_details,
        ]);
    }

    }
