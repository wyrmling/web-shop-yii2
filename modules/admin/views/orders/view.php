<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр заказа №' . $order->order_id, 'url' => ["orders/view/$order->order_id"]];
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

<?php foreach ($order_details as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . Html::a($details->product->title, ['products/view', 'id' => $details->product_id], ['target' => '_blank']) ?></div>
        <div><?= 'Количество: ' . $details->quantity ?></div>
        <div><?= 'Цена товара на момент заказа: ' . $details->price ?></div>
        <?php if (isset($details->product->special_price)): ?>
            <div><?= 'Актуальная цена: ' . $details->product->special_price ?></div>
        <?php else: ?>
            <div><?= 'Актуальная цена: ' . $details->product->price ?></div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Сумма по ценам на момент заказа: ' . $order_info['ordered_string'] . ' = <b>' . $order_info['ordered_sum'] . '</b>' ?></div>
<div><?= 'Сумма заказа по актуальным ценам: ' . $order_info['current_string'] . ' = <b>' . $order_info['current_sum'] . '</b>' ?></div>
<div><?= 'Зафиксированная (занесенная в БД) сумма заказа: <b>' . $order_info['fixed_sum'] . '</b>' ?></div>

<br>
<?= Html::a('Редактировать заказ', ['orders/edit', 'id' => $order->order_id,], ['class' => 'btn btn-success']) ?>

<br><br>
<div><b>Комментарий заказчика</b></div>
<div><?= Html::encode($order->client_comment) ?></div>
<br>
<div><b>Комментарий менеджера</b></div>
<div><?= Html::encode($order->manager_comment) ?></div>
