<?php

//use dosamigos\ckeditor\CKEditorInline;
//use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use app\models\Products;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление товара';


$model['brand_id'] = 1;
$model['status'] = 0;
?>
<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'title' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Название'], 'hint' => 'Обязательно заполните это поле'],
            'sku' => ['type' => Form::INPUT_TEXT],
            'article' => ['type' => Form::INPUT_TEXT],
            'brand_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Бренд'], 'hint' => 'Обязательно заполните это поле'],
            'description' => ['type' => Form::INPUT_TEXT],
            'price' => ['type' => Form::INPUT_TEXT],
            'special_price' => ['type' => Form::INPUT_TEXT],
            'status' => [
                'type' => Form::INPUT_RADIO_LIST,
                'items' => [Products::VISIBLE => Products::getProductStatus(Products::VISIBLE), Products::HIDDEN => Products::getProductStatus(Products::HIDDEN)],
                'options' => ['inline' => true],
            ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>