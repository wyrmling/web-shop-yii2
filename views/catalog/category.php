<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

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

<br><br>

<?php foreach ($products as $product): ?>
    <div>
        <b> <?= Html::encode("{$product->title}") ?> </b>
        <div>
            <?= Html::encode("{$product->brand->brand_name}") ?>
        </div>
        <div>
            <?= Html::encode("цена: {$product->price} (специальная цена: {$product->special_price})") ?>
        </div>
    </div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>