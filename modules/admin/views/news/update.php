<?php
use dosamigos\ckeditor\CKEditorInline;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
if ($type === 'create') {
    $this->params['breadcrumbs'][] = 'Создание новости';
} else {
    $this->params['breadcrumbs'][] = 'Редактирование новости';
}

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form ActiveForm */
?>
<div class="admin-edit">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
        <?= $form->field($model, 'description')->textInput() ?>
        <?= $form->field($model, 'content')->textarea() ?>
        <?= $form->warning($model->user->username) ?>
        <?= $model->user->username; ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
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
