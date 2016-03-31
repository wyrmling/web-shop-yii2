<?php

use yii\helpers\Html;
//use app\models\Articles;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление бренда';
?>
<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'brand_name' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
                //'hint' => 'Обязательно заполните это поле'
            ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>