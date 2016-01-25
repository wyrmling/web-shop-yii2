<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPach as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}
?>

<div>
    <?php foreach ($subcategories as $category): ?>
        <div class="category">
            подкатегория <?= $category->category_id ?> - <?= Html::a("$category->name", ['/catalog/category/', 'id' => $category->category_id]) ?>
           <br> количество товаров ( <?= $category->quantity_visible ?> ) ( <?= $category->quantity_invisible ?> )
        </div>
    <?php endforeach; ?>
</div>

<div class="clear"></div>

<?php foreach ($products as $product): ?>
    <div class="product">
        <b> <?= Html::a("$product->title", ['/products/', 'id' => $product->product_id]) ?> </b>
            <div>
                <?= Html::encode("{$product->brand->brand_name}") ?>
            </div>
            <div>
                <?= Html::encode("цена: {$product->price} (специальная цена: {$product->special_price})") ?>
            </div>
    </div>
<?php endforeach; ?>

<div class="clear"></div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>