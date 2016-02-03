<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Alert;
use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;
use app\models\Brands;
use app\models\Categories;
use yii\helpers\ArrayHelper;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование данных о товаре (' . $model->product_id . ') "'. $model->title . '"';
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
    echo Html::a('Список атрибутов товара', ['/admin/products/list', 'id' => $model->product_id], ['class' => 'btn btn-success']);
    
    $form = ActiveForm::begin([
                'id' => 'login-form-horizontal',
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <div class="form-group field-news-description">
        <label class="control-label col-sm-3" for="product-description">Выставить в продажу</label>
        <div class="col-sm-9">
            <?= Html::tag('span', Html::encode($model->status), ['class' => 'label status-' . $model->status]); ?>
        </div>
    </div>

    <?= $form->field($model, 'status')->checkbox() ?>
    <?= $form->field($model, 'title')->textInput()->hint('Обязательно заполните это поле') ?>
    <?= $form->field($model, 'sku')->textInput() ?>
    <?= $form->field($model, 'article')->textInput() ?>
    <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map(Brands::find()->all(), 'brand_id', 'brand_name')) ?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Categories::find()->all(), 'category_id', 'name')) ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'special_price')->textInput() ?>
    <?= $form->field($model->createdBy, 'username')->staticInput(); ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

