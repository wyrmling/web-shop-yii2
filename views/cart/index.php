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

<?php //var_dump (Yii::$app->session->get('productsarray')); ?>
<br>
<?php //var_dump (array_count_values(Yii::$app->session->get('productsarray'))); ?>
<br>

<?php Pjax::begin(); ?>

<?php if (count(Yii::$app->session->get('productsarray'))): ?>

    <?php foreach (array_count_values(Yii::$app->session->get('productsarray')) as $key => $value): ?>

        <div class="product">
            <img src="http://dummyimage.com/150x100/fafafa/3ea1ec" alt="..." class="img-thumbnail" style="float: left">
            <b><?= Html::a(Html::encode($products[$key]['title']), ['products/', 'id' => Html::encode($products[$key]['product_id'])], ['target' => '_blank', 'data-pjax'=>0]) ?></b>
            <div>Бренд:
                <?= Html::encode($products[$key]['brand_name']) ?>
            </div>
            <div>Цена:
                <?= Html::encode($products[$key]['price']) ?>
                ( Специальная цена: <?= Html::encode($products[$key]['special_price']) ?> )
            </div>
            <div>Количество:
                <?= Html::encode($value) ?>
            </div>
            <br>
            <?php // Html::a('[удалить из корзины]', ['cart/delete', 'id' => $key]) ?>
            <div>
                <input type="button" value="удалить из корзины" id="addproduct" onclick="deleteproduct(<?= $key ?>)">
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

<?php Pjax::end(); ?>