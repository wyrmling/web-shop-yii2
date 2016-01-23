<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPach as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}
?>

<ul>
<?php foreach ($subcategories as $category): ?>
        <li>
        <?= $category->category_id ?> - <?= Html::a("$category->name", ['/catalog/category/', 'id' => $category->category_id]) ?>
            ( <?= $category->quantity_visible ?> ) ( <?= $category->quantity_invisible ?> )
        </li>
<?php endforeach; ?>
</ul>


