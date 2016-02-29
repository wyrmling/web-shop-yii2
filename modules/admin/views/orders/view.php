<?php
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр заказа №' . $order->order_id, 'url' => ["orders/view/$order->order_id"]];
?>

<h2><?= 'Заказ № ' . $order->order_id ?></h2>

<div><?= 'Заказчик: ' . $order->user_id ?></div>
<div><?= 'Контактный номер: ' . $order->user_phone_number ?></div>
<div><?= 'Сумма заказа: ' . $order->total_sum ?></div>
<div><?= 'Дата заказа: ' . $order->time_ordered ?></div>

<div><b>Детали заказа:</b><div>

<?php foreach ($order_details as $details): ?>
<div class="product">
<div><?= 'Товар: ' . $details->product_id ?></div>
<div><?= 'Количество: ' . $details->quantity ?></div>
<div><?= 'Цена: ' . $details->price?></div>
</div>
<?php endforeach; ?>
        
<div class="clear"></div>

        <?php var_dump($order); ?>
        <br><br>
        <?php var_dump($order_details); ?>

