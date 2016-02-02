<?php

//use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

var_dump($att);

?>

<?php
$form = ActiveForm::begin([
            'id' => 'login-form-horizontal',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
?>

<?php foreach ($atributs_list as $i => $item): ?>
<?php $atributs_list[$i]['attribute_id'] = $i; ?>
    <?= $form->field($item, "[$i]attribute_id")->textInput(['readonly' => 'true']) ?>
    <?php $atributs_list[$i]['product_id'] = $product_id; ?>
    <?= $form->field($item, "[$i]product_id")->hiddenInput(['readonly' => 'true'])->label(false) ?>
    
            <?= $form->field($item, "[$i]value")->textInput() ?>

<?php endforeach; ?>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>
