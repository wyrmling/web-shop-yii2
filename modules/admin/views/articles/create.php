<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use app\models\Articles;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание статьи';
?>
<div class="admin-edit">

    <?php

    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'title' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Заголовок'], 'hint' => 'Обязательно заполните это поле'],
            'description' => ['type' => Form::INPUT_TEXT],
            'content' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => 'dosamigos\ckeditor\CKEditor', 'options' => ['options' => ['rows' => 6],'preset' => 'basic']],
            'article_status' => [
                'type' => Form::INPUT_RADIO_LIST,
                'items' => [Articles::VISIBLE => Articles::getStatus(Articles::VISIBLE), Articles::HIDDEN => Articles::getStatus(Articles::HIDDEN)],
                'options' => ['inline' => true],
            ],
            'comments_status' => [
                'type' => Form::INPUT_RADIO_LIST,
                'items' => [Articles::VISIBLE => Articles::getStatus(Articles::VISIBLE), Articles::HIDDEN => Articles::getStatus(Articles::HIDDEN)],
                'options' => ['inline' => true],
            ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>