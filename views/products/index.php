<?php

use yii\helpers\Html;
use app\models\AttributesList;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPach as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}
?>

<div> Название товара:
    <b> <?= Html::encode("{$product['title']}") ?> </b>
</div>
<div> Бренд:
    <?= Html::encode("{$product['brand_name']}") ?>
</div>
<div> SKU:
    <?= Html::encode("{$product['sku']}") ?>
</div>
<div> Артикул:
    <?= Html::encode("{$product['article']}") ?>
</div>
<div> Описание:
    <?= Html::encode("{$product['description']}") ?>
</div>
<div>
    <?= Html::encode("цена: {$product['price']} (специальная цена: {$product['special_price']})") ?>
</div>
<br>
<div>
    <?= Html::a('[добавить в корзину]', ['/cart/add', 'id' => $product['product_id']]) ?>
</div>

<br>
<div>
    Атрибуты товара:
</div>

<br><br>
<?php foreach ($attributes as $attribute): ?>
<div>
<?= $attribute['attribute_id'] ?> - <?= $attribute['attribute_name'] ?> -

    <?php
        if ($attribute['value']) {
            echo $attribute['value'];
        }
        ?>

(<?= $attribute['unit'] ?>)

</div>
<?php endforeach; ?>
