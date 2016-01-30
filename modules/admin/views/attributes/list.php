<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Список атрибутов для категории '. $category->category_id . ' - "' . $category->name . '"';

?>

<div>
    <?php foreach ($attributes as $list): ?>
        <div>
            <?= $list->attribute_id ?> -
            <?= $list->attributeinfo->attribute_name ?>
            ( <?= $list->attributeinfo->unit ?> )
            <?= Html::a('[удалить]', ['/admin/attributes/del', 'id' => $list->attribute_id, 'cat' => $list->category_id]) ?>
        </div>
    <?php endforeach; ?>
</div>

<?php
echo '<br><br>';
//var_dump($attributes);
