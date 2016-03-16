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
                ->leftJoin('users', 'users.user_id = orders.user_id')
                ->orderBy(['order_id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
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

        return $this->render('index', ['query' => $query,
            'dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        if (Orders::deleteAll(['order_id' => $id])){
            return $this->redirect('/admin/orders');
        }

    }

    public function actionPlus($id, $product_id)
    {
        $order = Orders::getOrderById($id);
        $order_details = OrderDetails::getOrderDetailsById($id, $product_id);

        Yii::$app->db->transaction(function($db) use ($order, $order_details, $id, $product_id) {
            $db->createCommand()
                    ->update('order_details', ['quantity' => $order_details->quantity + 1], "order_id = $id AND product_id = $product_id")
                    ->execute();
           // $db->createCommand()
             //       ->update('orders', ['total_sum' => $order->total_sum + $order_details->price], "order_id = $id")
               //     ->execute();
        });

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionMinus($id, $product_id)
    {
        $order = Orders::getOrderById($id);
        $order_details = OrderDetails::getOrderDetailsById($id, $product_id);

        if ($order_details->quantity > 1) {
            Yii::$app->db->transaction(function($db) use ($order, $order_details, $id, $product_id) {
                $db->createCommand()
                        ->update('order_details', ['quantity' => $order_details->quantity - 1], "order_id = $id AND product_id = $product_id")
                        ->execute();
             //   $db->createCommand()
               //         ->update('orders', ['total_sum' => $order->total_sum - $order_details->price], "order_id = $id")
                 //       ->execute();
            });
        }

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionDeleteproduct($id, $product_id)
    {
        $order = Orders::getOrderById($id);
        $order_details = OrderDetails::getOrderDetailsById($id, $product_id);

        Yii::$app->db->transaction(function($db) use ($order, $order_details, $id, $product_id) {
        //    $db->createCommand()
          //          ->update('orders', ['total_sum' => $order->total_sum - $order_details->price * $order_details->quantity], "order_id = $id")
            //        ->execute();
            $db->createCommand()
                    ->update('order_details', ['quantity' => 0], "order_id = $id AND product_id = $product_id")
                    ->execute();
        });

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionView($id)
    {
        $order = Orders::getOrderById($id);
        $order_details = OrderDetails::find()
                ->where(['order_id' => $id])
                ->leftJoin('products', 'products.product_id = order_details.product_id')
                ->all();

        $order_info = Orders::countTotalSumm($order, $order_details);

        return $this->render('view', [
                    'order' => $order,
                    'order_details' => $order_details,
                    'order_info' => $order_info,
        ]);
    }

    public function actionEdit($id)
    {
        $order = Orders::getOrderById($id);
        $order_details = OrderDetails::find()
                ->where(['order_id' => $id])
                ->leftJoin('products', 'products.product_id = order_details.product_id')
                ->all();

        $order_info = Orders::countTotalSumm($order, $order_details);

        return $this->render('edit', [
                    'order' => $order,
                    'order_details' => $order_details,
                    'order_info' => $order_info,
        ]);
    }

    public function actionFix($id, $fixed)
    {
        Yii::$app->db->transaction(function($db) use ($id, $fixed) {
            $db->createCommand()
                    ->update('orders', ['total_sum' => $fixed], "order_id = $id")
                    ->execute();
        });

        return $this->redirect('/admin/orders/edit/' . $id);
    }

    public function actionOrderDetail()
    {
        if (isset($_POST['expandRowKey'])) {
            $model = \app\models\OrderDetails::find()
                    ->where(['order_id' => $_POST['expandRowKey']])
                    ->leftJoin('products', 'products.product_id = order_details.product_id')
                    ->all();
            return Yii::$app->controller->renderPartial('_expand_view', ['model' => $model, 'id' => $_POST['expandRowKey']]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

}
