<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPath as $path) {
    $this->params['breadcrumbs'][] = ['label' => $path->name, 'url' => ["/catalog/category/$path->category_id"]];
}

$this->registerJs("
    function addproduct(productid) {
        $.ajax({
            type: 'POST',
            url: 'products/addproduct/',
            data: {id: productid},
             success: function(data) {
                if (JSON.parse(data) !== 'nok') {
                    $('#cartcounter').text('Корзина ('+JSON.parse(data)+')');
                }
            }
        });
    }", \yii\web\View::POS_END);
?>

<br>
<img src="http://dummyimage.com/450x300/fafafa/3ea1ec" alt="..." class="img-thumbnail" style="float: left">
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
    <?= Html::encode("цена: {$product['price']} (специальная цена: {$product['special_price']})") ?>
</div>
<br>
<div>
    <?php //Html::a('[добавить в корзину]', ['/cart/add', 'id' => $product['product_id']]) ?>
</div>
<br>

<?php if (!(Yii::$app->request->referrer == 'http://' . $_SERVER['HTTP_HOST'] . '/cart/index')): ?>
    <div>
        <input type="button" value="добавить в корзину" id="addproduct" onclick="addproduct(<?= $product['product_id'] ?>)">
        <?php
        Modal::begin([
            'header' => '<h3>Связаться с менеджером</h3>',
            'toggleButton' => [
                'label' => 'Купить сейчас',
            ],
        ]);
        echo $this->context->renderPartial('/site/_contact');
        echo \Yii::$app->view->renderFile('@app/views/site/_contact.php');
        Modal::end();
        ?>
    </div>
<?php endif; ?>

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