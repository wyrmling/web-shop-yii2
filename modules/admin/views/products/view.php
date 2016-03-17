<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPath as $path) {
    $this->params['breadcrumbs'][] = ['label' => $path->name, 'url' => ["/catalog/category/$path->category_id"]];
}
?>
<div> Название товара:
    <b> <?= Html::encode($product['title']) ?> </b>
</div>
<div> Бренд:
    <?= Html::encode($product['brand_name']) ?>
</div>
<div> SKU:
    <?= Html::encode($product['sku']) ?>
</div>
<div> Артикул:
    <?= Html::encode($product['article']) ?>
</div>
<div> Описание:
    <?= Html::encode($product['description']) ?>
</div>
<div>
    цена: <?= Html::encode($product['price']) ?> (специальная цена: <?= Html::encode($product['special_price']) ?>)
</div>
<br>
<div>
    <?php //Html::a('[добавить в корзину]', ['/cart/add', 'id' => $product['product_id']]) ?>
</div>

<br>
<div>
    Атрибуты товара:
</div>

<br><br>
<?php
foreach ($attributes as $attribute) {
    echo '<div>';
    echo $attribute['attribute_id'] . ' - ' . $attribute['attribute_name'] . ' - ';

    if ($attribute['value']) {
        echo $attribute['value'];
    }

    echo '(' . $attribute['unit'] . ')';
    echo '</div>';
}