<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

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

<?php Pjax::begin(['enablePushState' => false]); ?>
<?php foreach ($order_details as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . Html::a($details->product->title, ['products/view', 'id' => $details->product_id], ['target' => '_blank']) ?></div>
        <div><?= 'Количество: ' . $details->quantity ?>
            <?= Html::a('[+]', ['orders/plus/', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-success']) ?>
            <?= Html::a('[-]', ['orders/minus/', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-warning']) ?>
        </div>
        <div><?= 'Цена товара на момент заказа: ' . $details->price ?></div>
        <?php if (isset($details->product->special_price)): ?>
            <div><?= 'Актуальная цена: ' . $details->product->special_price ?></div>
        <?php else: ?>
            <div><?= 'Актуальная цена: ' . $details->product->price ?></div>
        <?php endif; ?>
        <div><?= Html::a('Удалить', ['orders/deleteproduct/', 'id' => $order->order_id, 'product_id' => $details->product_id,], ['class' => 'btn btn-danger']) ?></div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<div><?= 'Сумма по ценам на момент заказа: ' . $order_info['ordered_string'] . ' = <b>' . $order_info['ordered_sum'] . '</b>' ?></div>
<div><?= 'Сумма заказа по актуальным ценам: ' . $order_info['current_string'] . ' = <b>' . $order_info['current_sum'] . '</b>' ?></div>
<div><?= 'Зафиксированная (занесенная в БД) сумма заказа: <b>' . $order_info['fixed_sum'] . '</b>' ?></div>
<?php Pjax::end(); ?>

<br>
<?= Html::a('Зафиксировать сумму', ['orders/fix', 'id' => $order->order_id, 'fixed' => $order_info['current_sum'],], ['class' => 'btn btn-success']) ?>

<br><br>
<div><b>Комментарий заказчика</b></div>
<div><?= Html::encode($order->client_comment) ?></div>
<br>
<div><b>Комментарий менеджера</b></div>
<div><?= Html::encode($order->manager_comment) ?></div>