<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use app\models\Attributes;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Список атрибутов для категории ' . $category->category_id . ' - "' . $category->name . '"';

$model['category_id'] = $category->category_id;
$exept = ArrayHelper::map($attributes, 'attribute_id', 'attribute_id');
?>

<?php if(!$attributes){
    echo 'Для данной категории список атрибутов еще не составлен';
}
?>

<div>
    <?php foreach ($attributes as $list): ?>
        <div>
            <?= $list->attribute_id ?> -
            <?= $list->attributeinfo->attribute_name ?>
            ( <?= $list->attributeinfo->unit ?> )
            <?= Html::a('[удалить]', ['/admin/attributes/del/', 'id' => $list->attribute_id, 'cat' => $list->category_id]) ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'category_id' => ['type' => Form::INPUT_HIDDEN],
            'attribute_id' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Attributes::find()->where(['not', ['attribute_id' => $exept]])->orderBy('attribute_name')->all(), 'attribute_id', 'attribute_name'),
                'options' => ['inline' => true, 'prompt' => '-- Выберите атрибут --'],
            ],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Добавить атрибут', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<div>
Список атрибутов будет отображаться в том же порядке, в каком Вы его составите: <br><br>
</div>
