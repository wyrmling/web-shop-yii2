<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

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

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'form-horizontal']]); ?>
        <div class="form-group">
            <?= Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label status-' . $model->news_status]); ?>
        </div>
        <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
        <?= $form->field($model, 'description')->textInput() ?>
        <?= $form->field($model, 'content')->textarea() ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?= (!empty($model->user)) ? $model->user->username : Yii::$app->user->identity->username; ?></p>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>