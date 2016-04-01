<?php

use yii\grid\GridView;
?>

<div class="subblock">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'product_id',
            'category_id',
            'brand.brand_name',
            'title',
            'price',
            'special_price',
        ],
    ])
    ?>
</div>