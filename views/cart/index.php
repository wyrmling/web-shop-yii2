<?php

use yii\helpers\Html;
?>

<h2>Корзина</h2>

<?php if(!count(Yii::$app->session->get('productsarray'))){
    echo 'Нет выбранных товаров';
}
?>

<?php foreach (Yii::$app->session->get('productsarray') as $key => $value): ?>

    <div>
        <?= Html::encode($products[$value]['title']) ?>
        <?= Html::encode($products[$value]['brand_name']) ?>
        <?= Html::encode($products[$value]['price']) ?>
        ( <?= Html::encode($products[$value]['special_price']) ?> )
        <?= Html::a('[удалить из корзины]', ['/cart/delete', 'id' => $key]) ?>
    </div>

<?php endforeach; ?>
