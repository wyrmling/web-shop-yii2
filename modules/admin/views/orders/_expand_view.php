<?php foreach ($model as $details): ?>
    <div class="orderdetails">
        <div><?= 'ID товара: ' . $details->product_id ?></div>
        <div><?= 'Название товара: ' . $details->product->title ?></div>
        <div>Количество: <?= $details->quantity ?></div>
        <div>Цена: <?= $details->price ?></div>
    </div>
<?php endforeach; ?>
<div class="clear"></div>