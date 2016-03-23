<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление заказа';
?>

<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    $form->field($model, 'user_phone_number')->hint('')->label()->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '+38 (999) 999-99-99',
]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'entered_name' => ['type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
            //'hint' => 'Обязательно заполните это поле'
            ],
            'user_phone_number' => ['type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
            ],
            'status' => ['type' => Form::INPUT_TEXT],
            'total_sum' => ['type' => Form::INPUT_TEXT],
            'client_comment' => ['type' => Form::INPUT_TEXT],
            'manager_comment' => ['type' => Form::INPUT_TEXT],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
