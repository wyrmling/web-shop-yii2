<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Orders;
use yii\widgets\Pjax;

$sum = 0;

$this->registerJs("
    function deleteproduct(productid) {
        $.ajax({
            type: 'POST',
            url: '/cart/delete/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $.pjax({container: '#w0'});
                }
            }
        });
    }", \yii\web\View::POS_END);
?>

<h2>Корзина</h2>

<?php Pjax::begin(); ?>

<?php if (count(Yii::$app->session->get('productsarray'))): ?>

    <?php foreach (Yii::$app->session->get('productsarray') as $key => $value): ?>

        <div class="product">
            <b> <?= Html::encode($products[$value]['title']) ?> </b>
            <?= Html::encode($products[$value]['brand_name']) ?>
            <div>Цена:
                <?= Html::encode($products[$value]['price']) ?>
                ( Специальная цена: <?= Html::encode($products[$value]['special_price']) ?> )
            </div>
            <br>
            <?php // Html::a('[удалить из корзины]', ['cart/delete', 'id' => $key]) ?>
            <div>
                <input type="button" value="удалить из корзины" id="addproduct" onclick="deleteproduct(<?= $key ?>)">
            </div>
        </div>

        <?php
        if (isset($products[$value]['special_price'])) {
            $sum += $products[$value]['special_price'];
        } else {
            $sum += $products[$value]['price'];
        }
        ?>

    <?php endforeach; ?>

    <div class="clear"></div>
    <br>
    <div>
        Общая сумма заказа: <?= $sum ?> <br><br>
    </div>

<?php endif; ?>

<?php if ($res): ?>

    <div>
        Ваш заказ принят <br>
        Наш оператор свяжется с Вами по указанному телефону
    </div>

<?php elseif (count(Yii::$app->session->get('productsarray'))): ?>


    <div>Чтобы сделать заказ, введите имя и номер телефона, по которому с Вами можно связаться</div><br>
    <div>
        <?php
        $form = ActiveForm::begin();
        ?>
        <?= $form->field($order, 'entered_name')->textInput(['maxlength' => 30])->hint('')->label() ?>
        <?=
        $form->field($order, 'user_phone_number')->hint('')->label()->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+38 (999) 999-99-99',
        ])
        ?>

        <?= $form->field($order, 'status')->hiddenInput(['value' => Orders::UNANSWERED])->label(false) ?>
        <?= $form->field($order, 'total_sum')->hiddenInput(['value' => $sum])->label(false) ?>

        <?= $form->field($order, 'client_comment')->textarea(['maxlength' => 255]) ?>

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

<?php Pjax::end(); ?>