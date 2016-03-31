<?php

//use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use app\models\Attributes;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование данных о товаре', 'url' => ["products/edit/$product->product_id"]];
$this->params['breadcrumbs'][] = 'Список атрибутов товара ('. $product->product_id . ') "'. $product->title . '"';

echo "Товар: ($product->product_id) \" $product->title \" ";
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
    <?= $form->field($item, "[$i]attribute_id")->hiddenInput(['readonly' => 'true'])->label(false) ?>
    <?php $params = Attributes::findOne(['attribute_id' => $i]); ?>
    <?= $params->attribute_name ?> (<?= $params->unit ?>)
    <?php $atributs_list[$i]['product_id'] = $product->product_id; ?>
    <?= $form->field($item, "[$i]product_id")->hiddenInput(['readonly' => 'true'])->label(false) ?>

    <?= $form->field($item, "[$i]value")->textInput() ?>

<?php endforeach; ?>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>