<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Orders;

$sum = 0;

$this->registerJs("
    function upquantity(productid) {
        var newvalue = Number($('#product_'+productid+'.quantity').html().substring(12)) + 1;        
        $.ajax({
            type: 'POST',
            url: '/cart/upquantity/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $('#product_'+productid+'.quantity').text('Количество: '+newvalue);
                }
            }
        });
    }", \yii\web\View::POS_END);

$this->registerJs("
    function downquantity(productid) {
        var newvalue = Number($('#product_'+productid+'.quantity').html().substring(12)) - 1;        
        $.ajax({
            type: 'POST',
            url: '/cart/downquantity/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $('#product_'+productid+'.quantity').text('Количество: '+newvalue);
                    if (newvalue == '0') {
                    $('#product_'+productid+'.product').remove();
                    }
                    if (JSON.parse(data) == '0') {
                    location.reload();
                    }
                }
            }
        });
    }", \yii\web\View::POS_END);

$this->registerJs("
    function deleteproduct(productid) {
        $.ajax({
            type: 'POST',
            url: '/cart/delete/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                    $('#product_'+productid+'.product').remove();
                    if (JSON.parse(data) == '0') {
                    location.reload();
                    }
                }
            }
        });
    }", \yii\web\View::POS_END);
?>

<h2>Корзина</h2>

<?php if (count(Yii::$app->session->get('productsarray'))): ?>

    <?php foreach (array_count_values(Yii::$app->session->get('productsarray')) as $key => $value): ?>

        <div class="product" id="product_<?= Html::encode($products[$key]['product_id']) ?>">
            <img src="http://dummyimage.com/150x100/fafafa/3ea1ec" alt="..." class="img-thumbnail" style="float: left">
            <b><?= Html::a(Html::encode($products[$key]['title']), ['products/', 'id' => Html::encode($products[$key]['product_id'])], ['target' => '_blank', 'data-pjax' => 0]) ?></b>
            <div>Бренд:
                <?= Html::encode($products[$key]['brand_name']) ?>
            </div>
            <div>Цена:
                <?= Html::encode($products[$key]['price']) ?>
                ( Специальная цена: <?= Html::encode($products[$key]['special_price']) ?> )
            </div>
            <div class="quantity" id="product_<?= Html::encode($products[$key]['product_id']) ?>">Количество:
                <?= Html::encode($value) ?>
            </div>
            <br>
            <div class="productbuttons">
                <input type="button" value="+" id="upquantity" onclick="upquantity(<?= Html::encode($products[$key]['product_id']) ?>)">
                <input type="button" value="-" id="downquantity" onclick="downquantity(<?= Html::encode($products[$key]['product_id']) ?>)">
                <input type="button" value="удалить из корзины" id="deleteproduct" onclick="deleteproduct(<?= $key ?>)">
            </div>
        </div>

        <?php
        if (isset($products[$key]['special_price'])) {
            $sum += $products[$key]['special_price'] * $value;
        } else {
            $sum += $products[$key]['price'] * $value;
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
