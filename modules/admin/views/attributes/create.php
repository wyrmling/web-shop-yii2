<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание атрибута';
?>

<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'attribute_name' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
            ],
            'unit' => ['type' => Form::INPUT_TEXT],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>