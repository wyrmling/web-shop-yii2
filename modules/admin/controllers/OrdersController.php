<?php

namespace app\modules\admin\controllers;

use app\models\Orders;

class OrdersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDelete($id) {
        if (Orders::deleteAll(['order_id' => $id]))
            return $this->redirect('/admin/orders');
    }

}
