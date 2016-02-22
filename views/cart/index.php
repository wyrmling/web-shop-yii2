<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Orders;

$sum = 0;
?>

<h2>Корзина</h2>

<?php if (count(Yii::$app->session->get('productsarray'))): ?>

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
            $sum += $products[$value]['special_price'];
        } else {
            $sum += $products[$value]['price'];
        }
        ?>

    <?php endforeach; ?>

    <br><br>
    <div>
        Общая сумма заказа: <?= $sum ?>
    </div>

<?php endif; ?>

<?php if ($res): ?>

    <div>
        Ваш заказ принят <br>
        Наш оператор свяжется с Вами по указанному телефону
    </div>

<?php elseif (count(Yii::$app->session->get('productsarray'))): ?>

    <div>
        <?php
        $form = ActiveForm::begin();
        ?>

        <?= $form->field($order, 'user_phone_number')->hint('Чтобы сделать заказ, введите номер телефона, по которому с Вами можно связаться')->label(false)->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '(999) 999-99-99',
]) ?>
        
        <?= $form->field($order, 'status')->hiddenInput(['value' => Orders::UNANSWERED])->label(false) ?>
    <?= $form->field($order, 'total_sum')->hiddenInput(['value' => $sum])->label(false) ?>

        <div class="form-group">
    <?= Html::submitButton('Отправить заказ', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

    <?php else: ?>

    <div>
        Нет выбранных товаров
    </div>

<?php endif; ?>

    var_dump(Yii::$app->session->get('productsarray')): 
    <?php var_dump(Yii::$app->session->get('productsarray')); ?>
    
    var_dump(array_count_values(Yii::$app->session->get('productsarray')))
    <?php var_dump(array_count_values(Yii::$app->session->get('productsarray'))); ?>
    
     var_dump($products): 
    <?php var_dump($products); ?>
