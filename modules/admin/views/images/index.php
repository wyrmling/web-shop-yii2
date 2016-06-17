<?php

use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'downloadFile')->fileInput() ?>
<?= $form->field($model, 'object_type_id')->hiddenInput(['value' => 1111])->label(false); ?>
<?= $form->field($model, 'object_id')->hiddenInput(['value' => 2222])->label(false); ?>
<?= $form->field($model, 'name')->hiddenInput(['value' => 'ffff'])->label(false); ?>

<button>Submit</button>

<?php ActiveForm::end() ?>