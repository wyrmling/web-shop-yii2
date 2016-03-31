<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use app\models\News;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание новости';
?>
<div class="admin-edit">

    <?php

    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
//            'fld1'=>['label'=>'Name','type'=>Form::INPUT_TEXT, 'value'=>'Kartik'],
            'title' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Заголовок'],
                'hint' => 'Обязательно заполните это поле'
            ],
            'description' => ['type' => Form::INPUT_TEXT],
            'content' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => 'dosamigos\ckeditor\CKEditor',
                'options' => ['options' => ['rows' => 6],'preset' => 'basic']
            ],
//            'user_id' => [
//                'type'=> Form::INPUT_STATIC,
//                'staticValue' => (!empty($model->user)) ? $model->user->username : Yii::$app->user->identity->username,
//                'label' => Html::label('Пользователь'),
//            ],
            'news_status' => [
                'type' => Form::INPUT_RADIO_LIST,
                'items' => [News::VISIBLE => News::getStatus(News::VISIBLE), News::HIDDEN => News::getStatus(News::HIDDEN)],
                'options' => ['inline' => true],
            ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>