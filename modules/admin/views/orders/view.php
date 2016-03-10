<?php
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр заказа №' . $order->order_id, 'url' => ["orders/view/$order->order_id"]];
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
        <div><?= 'Количество: ' . $details->quantity ?></div>
        <div><?= 'Цена: ' . $details->price ?></div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Сумма заказа: <b>' . $order->total_sum . '</b>' ?></div>

<?php //var_dump($order); ?>
<br><br>
<?php //var_dump($order_details); ?>

