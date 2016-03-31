<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование атрибута товара (' . $model->attribute_id . ')';
?>

<div class="admin-edit">

    <?php
    if (!empty($results)) {
        echo Alert::widget([
            'options' => [
                'class' => ($results) ? 'alert-success' : 'alert-danger'
            ],
            'body' => ($results) ? 'Сохранение успешно.' : 'Ошибка.'
        ]);
    }

    $form = ActiveForm::begin([
        'id' => 'login-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'attribute_name')->textInput()->hint('Обязательно заполните это поле') ?>
    <?= $form->field($model, 'unit')->textInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>