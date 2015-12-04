<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
if ($type === 'create') {
    $this->params['breadcrumbs'][] = 'Создание статьи';
} else {
    $this->params['breadcrumbs'][] = 'Редактирование статьи';
}

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form ActiveForm */
?>
<div class="admin-edit">

    <?php
    if (!empty($res)) {
        echo Alert::widget([
            'options' => [
                'class' => ($res) ? 'alert-success' : 'alert-danger'
            ],
            'body' => ($res) ? 'Сохранение успешно.' : 'Ошибка.'
        ]);
    }
    ?>

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'form-horizontal']]); ?>
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
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- admin-edit -->

<?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>


    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
