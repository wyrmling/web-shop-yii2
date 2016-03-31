<?php

use yii\helpers\Html;
use app\models\Categories;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
if (!empty($parent_category_id)) {
    $this->params['breadcrumbs'][] = 'Добавление подкатегории в категорию ' . $parent_category_id . ' - "' . $name . '"';
} else {
    $this->params['breadcrumbs'][] = 'Добавление категории';
}

$model['parent_category_id'] = $parent_category_id;
?>

<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'name' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Введите название категории (подкатегории)'],
                'hint' => 'Обязательно заполните это поле'
            ],
            'parent_category_id' => ['type' => Form::INPUT_HIDDEN],
        ],
    ]);
    ?>

    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>