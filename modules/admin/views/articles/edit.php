<?php

//use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;
//use kartik\checkbox\CheckboxX;
//use kartik\switchinput\SwitchInput;
use app\models\Files;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование статьи (' . $model->article_id . ')';

//var_dump($_FILES);
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

    <div class="form-group field-news-description">
        <label class="control-label col-sm-3" for="article-description">Разрешить публикацию</label>
        <div class="col-sm-9">
            <?= Html::tag('span', Html::encode($model->article_status), ['class' => 'label status-' . $model->article_status]); ?>
        </div>
    </div>

    <?= $form->field($model, 'article_status')->checkbox() ?>
    <?= $form->field($model, 'comments_status')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 3, 'cols' => 5]) ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic']) ?>
    <?php //$form->field($model->createdBy, 'username')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model->createdBy, 'username')->staticInput(); ?>

    <?= $form->field($upload_files, 'downloadFile')->fileInput() ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>