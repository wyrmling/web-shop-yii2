<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование новости ('.$model->news_id.')';

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form ActiveForm */
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
        <label class="control-label col-sm-3" for="news-description">Статус новости</label>
        <div class="col-sm-9">
            <?= Html::tag('span', Html::encode($model->news_status), ['class' => 'label status-' . $model->news_status]); ?>
        </div>
    </div>

    <?= $form->field($model, 'news_status')->widget(SwitchInput::classname(), [
        'items' => [
            ['label' => 'Medium', 'value' => 'hidden'],
            ['label' => 'Low', 'value' => 'visible'],
        ],
        'pluginOptions' => [
            'size' => 'mini',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]); ?>
    <?= $form->field($model, 'news_status')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'content')->textarea() ?>
    <?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'basic']) ?>
    <?= $form->field($model->user, 'username')->textInput(['readonly' => 'true']) ?>
    <?= $form->field($model->user, 'username')->staticInput(); ?>
    <?= $form->field($model, 'time_created')->staticInput(); ?>
    <?= $form->field($model, 'created_by')->staticInput(); ?>
    <?= $form->field($model, 'time_updated')->staticInput(); ?>
    <?= $form->field($model, 'updated_by')->staticInput(); ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>