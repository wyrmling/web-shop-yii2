<?php

namespace app\modules\admin\controllers;

use yii\data\ActiveDataProvider;
use app\models\Orders;
use app\models\OrderDetails;
use Yii;

class OrdersController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $query = (new \yii\db\Query())
            ->select('*')
            ->from('orders')
            ->leftJoin('users', 'users.user_id = orders.user_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'key' => 'order_id',
        ]);
// join with relation `user` that is a relation to the table `users`
// and set the table alias to be `Заказчик`
//$query->joinWith(['user' => function ($query) {
//    $query->from(['user' => 'users']);
//}]);
//// enable sorting for the related column
//$dataProvider->sort->attributes['user.username'] = [
//    'asc' => ['user.username' => SORT_ASC],
//    'desc' => ['user.username' => SORT_DESC],
//];

        return $this->render('index', ['query' => $query, 'dataProvider' => $dataProvider]);
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

        Yii::$app->db->transaction(function($db) use ($order, $order_details, $id, $product_id) {
            $db->createCommand()
                ->update('order_details', ['quantity' => $order_details->quantity + 1], "order_id = $id AND product_id = $product_id")
                ->execute();
            $db->createCommand()
                ->update('orders', ['total_sum' => $order->total_sum + $order_details->price], "order_id = $id")
                ->execute();
        });

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
            Yii::$app->db->transaction(function($db) use ($order, $order_details, $id, $product_id) {
                $db->createCommand()
                    ->update('order_details', ['quantity' => $order_details->quantity - 1], "order_id = $id AND product_id = $product_id")
                    ->execute();
                $db->createCommand()
                    ->update('orders', ['total_sum' => $order->total_sum - $order_details->price], "order_id = $id")
                    ->execute();
            });
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

    public function actionOrderDetail() {
        if (isset($_POST['expandRowKey'])) {
            $model = \app\models\OrderDetails::findAll(['order_id' => $_POST['expandRowKey']]);
            return Yii::$app->controller->renderPartial('_expand_view', ['model' => $model, 'id' => $_POST['expandRowKey']]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

}