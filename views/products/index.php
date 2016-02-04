<?php

use yii\helpers\Html;
use app\models\AttributesList;

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

<br>
<div>
    Атрибуты товара:
</div>

<?php foreach ($att as $attribute => $item): ?>
    <div>
        <?= $item->attribute_id ?> - <?= $item->attributename->attribute_name ?> -

        <?php
        if ($value = AttributesList::findOne([
                    'attribute_id' => $item->attribute_id,
                    'product_id' => $product->product_id
                ])) {
            echo $value->value;
        }
        ?>

        (<?= $item->attributename->unit ?>)
    </div>
<?php endforeach; ?>
