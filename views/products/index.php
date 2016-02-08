<?php

use yii\helpers\Html;
use app\models\AttributesList;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPach as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}
?>

<div> Название товара:
    <b> <?= Html::encode("{$product[0]['title']}") ?> </b>
</div>
<div> Бренд:
    <?= Html::encode("{$product[0]['brand_name']}") ?>
</div>
<div> SKU:
    <?= Html::encode("{$product[0]['sku']}") ?>
</div>
<div> Артикул:
    <?= Html::encode("{$product[0]['article']}") ?>
</div>
<div> Описание:
    <?= Html::encode("{$product[0]['description']}") ?>
</div>
<div>
    <?= Html::encode("цена: {$product[0]['price']} (специальная цена: {$product[0]['special_price']})") ?>
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
                    'product_id' => $product[0]['product_id'],
                ])) {
            echo $value->value;
        }
        ?>

        (<?= $item->attributename->unit ?>)
    </div>
<?php endforeach; ?>

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
