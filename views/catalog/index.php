<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
?>

<div>
    <?php foreach ($categories as $category): ?>
        <div class="category">
            <div align="center">
                <img src="http://dummyimage.com/70x70/fafafa/3ea1ec" alt="..." class="img-thumbnail">
            </div>
            категория <?= $category['category_id'] ?> - <?= Html::a($category['name'], ['/catalog/category/', 'id' => $category['category_id']]) ?>
            <br> количество товаров ( <?= $category['quantity_visible'] ?> ) ( <?= $category['quantity_invisible'] ?> )
        </div>
    <?php endforeach; ?>
</div>

<div class="clear"></div>