
<?php $current_price = 0 ?>
<?php $ordered_price = 0 ?>
<?php foreach ($model as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . $details->product->title ?></div>
        <div><?= 'Количество: ' . $details->quantity ?></div>
        <div><?= 'Цена товара на момент заказа: ' . $details->price ?></div>
        <?php if (isset($details->product->special_price)): ?>
        <div><?= 'Актуальная цена: ' . $details->product->special_price ?></div>
        <?php $current_price += $details->product->special_price * $details->quantity ?>
        <?php else: ?>
        <div><?= 'Актуальная цена: ' . $details->product->price ?></div>
        <?php $current_price += $details->product->price * $details->quantity ?>
        <?php endif; ?>
        <?php $ordered_price += $details->price * $details->quantity ?>
    </div>
<?php endforeach; ?>

<div class="clear"></div>
<div><?= 'Сумма заказа (на момент заказа): <b>' . $ordered_price . '</b>' ?></div>
<div><?= 'Актуальная сумма заказа: <b>' . $current_price . '</b>' ?></div>
