<?php

use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование статьи (' . $model->article_id . ')';
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

    <div class="form-group field-news-description">
        <label class="control-label col-sm-3" for="article-description">Статус статьи</label>
        <div class="col-sm-9">
            <?= Html::tag('span', Html::encode($model->article_status), ['class' => 'label status-' . $model->article_status]); ?>
        </div>
    </div>

    <?= $form->field($model, 'article_status')->checkbox() ?>
    <?= $form->field($model, 'comments_status')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'content')->textarea() ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic']) ?>
    <?= $form->field($model->user, 'username')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model->user, 'username')->staticInput(); ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>