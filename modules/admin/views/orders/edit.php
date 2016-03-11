<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование заказа №' . $order->order_id, 'url' => ["orders/edit/$order->order_id"]];
?>
<h2><?= 'Заказ № ' . $order->order_id ?></h2>

<?php if (isset($order->user->username)): ?>
<div><?= 'Заказчик: ' . $order->user->username ?></div>
<?php endif; ?>
<div><?= 'Контактный номер: ' . $order->user_phone_number ?></div>
<div><?= 'Дата заказа: ' . $order->time_ordered ?></div>

<div><b>Детали заказа:</b></div>

<?php foreach ($order_details as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . $details->product->title ?></div>
        <div><?= 'Количество: ' . $details->quantity ?>
            <?= Html::a('[+]', ['orders/plus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-success']) ?>
            <?= Html::a('[-]', ['orders/minus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-warning']) ?>
        </div>
        <div><?= 'Цена товара на момент заказа: ' . $details->price ?></div>
        <?php if (isset($details->product->special_price)): ?>
        <div><?= 'Цена товара на текущий момент: ' . $details->product->special_price ?></div>
        <?php else: ?>
        <div><?= 'Цена товара на текущий момент: ' . $details->product->price ?></div>
        <?php endif; ?>
        <div><?= Html::a('Удалить', ['orders/deleteproduct', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-danger']) ?></div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Сумма заказа (на момент заказа): <b>' . $order->total_sum . '</b>' ?></div>

<?php //var_dump($order); ?>
    <br><br>
<?php //var_dump($order_details); ?>