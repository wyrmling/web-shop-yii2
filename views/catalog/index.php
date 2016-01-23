<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];

?>

<ul>
<?php foreach ($categories as $category): ?>
        <li>
        <?= $category->category_id ?> - <?= Html::a("$category->name", ['/catalog/category/', 'id' => $category->category_id]) ?>
            ( <?= $category->quantity_visible ?> ) ( <?= $category->quantity_invisible ?> )
        </li>
<?php endforeach; ?>
</ul>