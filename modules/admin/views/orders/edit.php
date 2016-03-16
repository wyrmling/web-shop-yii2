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
<?php if (isset($order->entered_name)): ?>
<div><?= 'Имя: ' . $order->entered_name ?></div>
<?php endif; ?>
<div><?= 'Контактный номер: ' . $order->user_phone_number ?></div>
<div><?= 'Дата заказа: ' . $order->time_ordered ?></div>

<div><b>Детали заказа:</b></div>
<?php $current_price = 0 ?>
<?php $ordered_price = 0 ?>
<?php foreach ($order_details as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . Html::a($details->product->title, ['products/view', 'id' => $details->product_id], ['target' => '_blank']) ?></div>
        <div><?= 'Количество: ' . $details->quantity ?>
            <?= Html::a('[+]', ['orders/plus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-success']) ?>
            <?= Html::a('[-]', ['orders/minus', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-warning']) ?>
        </div>
        <div><?= 'Цена товара на момент заказа: ' . $details->price ?></div>
        <?php if (isset($details->product->special_price)): ?>
        <div><?= 'Актуальная цена: ' . $details->product->special_price ?></div>
        <?php $current_price += $details->product->special_price * $details->quantity?>
        <?php else: ?>
        <div><?= 'Актуальная цена: ' . $details->product->price ?></div>
        <?php $current_price += $details->product->price * $details->quantity?>
        <?php endif; ?>
        <?php $ordered_price += $details->price * $details->quantity ?>
        <div><?= Html::a('Удалить', ['orders/deleteproduct', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-danger']) ?></div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Общая сумма по ценам на момент заказа: <b>' . $ordered_price . '</b>' ?></div>
<div><?= 'Актуальная сумма заказа: <b>' . $current_price . '</b>' ?></div>
<div><?= 'Зафиксированная сумма заказа: <b>' . $order->total_sum . '</b>' ?></div>

<?= Html::a('Зафиксировать сумму', ['orders/fix', 'id' => $order->order_id, 'fixed' => $current_price,], ['class' => 'btn btn-success']) ?>

<?php var_dump($qqq); ?>

<br><br>
<div><b>Комментарий заказчика</b></div>
<div><?= Html::encode($order->client_comment) ?></div>
<br>
<div><b>Комментарий менеджера</b></div>
<div><?= Html::encode($order->manager_comment) ?></div>

<?php //var_dump($order); ?>
    <br><br>
<?php //var_dump($order_details); ?>