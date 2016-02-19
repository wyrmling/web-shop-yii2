<?php

use yii\helpers\Html;

$summ = 0;
?>

<h2>Корзина</h2>

<?php if (!count(Yii::$app->session->get('productsarray'))): ?>

    <div>
        Нет выбранных товаров
    </div>

<?php else: ?>

    <?php foreach (Yii::$app->session->get('productsarray') as $key => $value): ?>

        <div>
            <b> <?= Html::encode($products[$value]['title']) ?> </b>
            <?= Html::encode($products[$value]['brand_name']) ?>
            <?= Html::encode($products[$value]['price']) ?>
            ( <?= Html::encode($products[$value]['special_price']) ?> )
            <?= Html::a('[удалить из корзины]', ['/cart/delete', 'id' => $key]) ?>
        </div>

        <?php
        if (isset($products[$value]['special_price'])) {
            $summ += $products[$value]['special_price'];
        } else {
            $summ += $products[$value]['price'];
        }
        ?>

    <?php endforeach; ?>
<?php endif; ?>

<br><br>
<div>
    Общая сумма заказа: <?= $summ ?>
</div>
<br><br>
<div>
    <?= Html::a('Сделать заказ', ['/cart/order',], ['class' => 'btn btn-success']); ?>
</div>