<?php foreach ($model as $details): ?>
    <div class="orderdetails">
        <div>Товар: <?= $details->product_id ?></div>
        <div>Количество: <?= $details->quantity ?></div>
        <div>Цена: <?= $details->price ?></div>
    </div>
<?php endforeach; ?>
<div class="clear"></div>