<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование заказа №' . $order->order_id, 'url' => ["orders/edit/$order->order_id"]];
?>
<h2><?= 'Заказ № ' . $order->order_id ?></h2>

<div><?= 'Заказчик: ' . $order->user_id ?></div>
<div><?= 'Контактный номер: ' . $order->user_phone_number ?></div>
<div><?= 'Дата заказа: ' . $order->time_ordered ?></div>

<div><b>Детали заказа:</b></div>

<?php foreach ($order_details as $details): ?>
    <div class="orderdetails">
        <div><?= 'Товар: ' . $details->product_id ?></div>
        <div><?= 'Количество: ' . $details->quantity ?>
            <?= Html::a('[+]', ['orders/plus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-success']) ?>
            <?= Html::a('[-]', ['orders/minus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-warning']) ?>
        </div>
        <div><?= 'Цена: ' . $details->price ?></div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Сумма заказа: <b>' . $order->total_sum . '</b>' ?></div>

<?php //var_dump($order); ?>
    <br><br>
<?php //var_dump($order_details); ?>