<?php ?>

<div>Чтобы сделать заказ, введите имя и номер телефона, по которому с Вами можно связаться</div><br>
<div>

<?= $form->field($order, 'entered_name')->textInput(['maxlength' => 30])->hint('')->label() ?>
    <?=
    $form->field($order, 'user_phone_number')->hint('')->label()->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38 (999) 999-99-99',
    ])
    ?>