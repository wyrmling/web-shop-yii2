<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Orders;

$this->registerJsFile('/js/cart.js', ['position' => \yii\web\View::POS_END]);
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

    <?php endforeach; ?>

    <div class="clear"></div>
    <br>
    <div class ="totalsum">
        Общая сумма заказа: <?= $total_sum ?>
    </div>
    <br><br>

<?php endif; ?>

<?php if ($res): ?>

    <div>
        Ваш заказ принят <br>
        Наш оператор свяжется с Вами по указанному телефону
    </div>

<?php elseif (count(Yii::$app->session->get('productsarray'))): ?>

    <?php
    $form = ActiveForm::begin();
    ?>

    <?php if (null != \Yii::$app->user->identity): ?>

        <?php // \Yii::$app->user->identity->getId() ?>

    <?php else: ?>

        <div>Чтобы сделать заказ, введите имя и номер телефона, по которому с Вами можно связаться</div><br>
        <div>

            <?= $form->field($order, 'entered_name')->textInput(['maxlength' => 30])->hint('')->label() ?>
            <?=
            $form->field($order, 'user_phone_number')->hint('')->label()->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+38 (999) 999-99-99',
            ])
            ?>

        <?php endif; ?>

        <?= $form->field($order, 'status')->hiddenInput(['value' => Orders::UNANSWERED])->label(false) ?>
        <?= $form->field($order, 'total_sum')->hiddenInput(['value' => $total_sum])->label(false) ?>

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


<?php
// без 'user_phone_number' заказ авторизованного пользьзователя не проходит
// добавить в таблицу users колонку с телефоном
// передавать телефон через форму