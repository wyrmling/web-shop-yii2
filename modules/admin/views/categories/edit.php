<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Переименование категории ' . $model->category_id . ' - "' . $model->name . '"';
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
    ?>

    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput()->hint('Обязательно заполните это поле') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>