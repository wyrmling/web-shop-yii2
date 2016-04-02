<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

Pjax::begin(['options' => ['id' => 'pj1']]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'product_id',
        'category_id',
        'brand.brand_name',
        'title',
        'price',
        'special_price',
    ],
]);
Pjax::end();