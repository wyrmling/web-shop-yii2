<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['/catalog']];
foreach ($fullPath as $pach) {
    $this->params['breadcrumbs'][] = ['label' => "$pach->name", 'url' => ["/catalog/category/$pach->category_id"]];
}
?>

<div class="filter">
    Фильтр товаров по брендам:
    <?php
    $form = ActiveForm::begin([
                'id' => 'active-form',
                //    'method' => 'get',
                //    'action' => ['catalog/index'],
                'options' => [
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data',
                    'name' => 'brandsfilter',
                ],
                'fieldConfig' => [
                    'template' => "{input}\n{label}\n{hint}\n{error}",
                ]
    ]);
    ?>

    <?php foreach ($brands as $attr => $item): ?>

        <?= $form->field($filtermodel, $attr)->checkbox(['label' => $item, 'name' => $attr]) ?>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'filter_submit']) ?>
        <?= Html::submitInput('Фильтровать', ['class' => 'btn btn-primary', 'name' => 'filter_submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<div class="content">
    <div> подкатегории категории " <?= $pach->name ?> ": </div>
    <div>
        <?php foreach ($subcategories as $category): ?>
            <div class="category">
                подкатегория <?= $category['category_id'] ?> - <?= Html::a("{$category['name']}", ['/catalog/category/', 'id' => $category['category_id']]) ?>
                <br> количество товаров ( <?= $category['quantity_visible'] ?> ) ( <?= $category['quantity_invisible'] ?> )
            </div>
        <?php endforeach; ?>
    </div>

    <div class="clear"></div>
    <div><br>товары категории " <?= $pach->name ?> ": </div>

    <?php foreach ($products as $product): ?>
        <div class="product">
            <div> Название товара:
                <b> <?= Html::a("{$product['title']}", ['/products/', 'id' => $product['product_id']]) ?> </b>
            </div>
            <div> Бренд:
                <?= Html::encode("{$product['brand_name']}") ?>
            </div>
            <div> Описание:
                <?= Html::encode("{$product['description']}") ?>
            </div>
            <div>
                <?= Html::encode("цена: {$product['price']} (специальная цена: {$product['special_price']})") ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="clear"></div>

    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>