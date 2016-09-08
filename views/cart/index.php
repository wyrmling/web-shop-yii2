<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Orders;
//use app\models\Users;
use yii\captcha\Captcha;

$this->registerJsFile('/js/cart.js', ['position' => \yii\web\View::POS_END]);

//var_dump(Yii::$app->user);
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

    <?php if (\Yii::$app->user->id): ?>

        <?=
        $this->render('_authorized_user_form', [
            'form' => $form,
            'order' => $order,
            'client_info' => $client_info,
        ]);
        ?>

    <?php else: ?>

        <?=
        $this->render('_not_authorized_user_form', [
            'form' => $form,
            'order' => $order,
        ]);
        ?>

    <?php endif; ?>

    <?= $form->field($order, 'status')->hiddenInput(['value' => Orders::UNANSWERED])->label(false) ?>
    <?= $form->field($order, 'total_sum')->hiddenInput(['value' => $total_sum])->label(false) ?>

    <?= $form->field($order, 'client_comment')->textarea(['maxlength' => 255]) ?>
    
    <?=
    $form->field($order, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ])
    ?>

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