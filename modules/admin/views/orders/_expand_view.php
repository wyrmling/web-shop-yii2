
<?php foreach ($model as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . $details->product->title ?></div>
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
