<?php

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model_1, 'downloadFile')->fileInput() ?>

<?= $form->field($model_2, 'object_type_id')->hiddenInput(['value' => 1111])->label(false); ?>
<?= $form->field($model_2, 'object_id')->hiddenInput(['value' => 2222])->label(false); ?>
<?= $form->field($model_2, 'image_title')->hiddenInput(['value' => 'ffff'])->label(false); ?>

<button>Submit</button>

<?php ActiveForm::end() ?>