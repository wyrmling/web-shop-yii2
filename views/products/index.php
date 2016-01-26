<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPach as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}

?>

<div> Название товара: 
<b> <?= Html::encode("{$product->title}") ?> </b>
</div>
<div> Бренд: 
    <?= Html::encode("{$product->brand->brand_name}") ?>
</div>
<div> SKU: 
    <?= Html::encode("{$product->sku}") ?>
</div>
<div> Артикул: 
    <?= Html::encode("{$product->article}") ?>
</div>
<div> Описание: 
    <?= Html::encode("{$product->description}") ?>
</div>
<div>
    <?= Html::encode("цена: {$product->price} (специальная цена: {$product->special_price})") ?>
</div>