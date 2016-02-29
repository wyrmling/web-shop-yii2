<?php

namespace app\modules\admin\controllers;

use app\models\Orders;
use app\models\OrderDetails;

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
                    'id' => $id,
                    'order' => $order,
                    'order_details' => $order_details,
        ]);
    }

}
