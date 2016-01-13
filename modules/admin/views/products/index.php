<?php

use yii\data\ActiveDataProvider;
use app\models\Products;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];

$query = Products::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);

$query->joinWith(['brand' => function($query) {
        $query->from(['brand' => 'product_brands']);
    }]);
        $dataProvider->sort->attributes['brand.brand_name'] = [
            'asc' => ['brand.brand_name' => SORT_ASC],
            'desc' => ['brand.brand_name' => SORT_DESC],
        ];

        $query->joinWith(['createdBy' => function($query) {
                $query->from(['createdBy' => 'users']);
            }]);
                $dataProvider->sort->attributes['createdBy.username'] = [
                    'asc' => ['createdBy.username' => SORT_ASC],
                    'desc' => ['createdBy.username' => SORT_DESC],
                ];

                $query->joinWith(['updatedBy' => function($query) {
                        $query->from(['updatedBy' => 'users']);
                    }]);
                        $dataProvider->sort->attributes['updatedBy.username'] = [
                            'asc' => ['updatedBy.username' => SORT_ASC],
                            'desc' => ['updatedBy.username' => SORT_DESC],
                        ];
                        ?>

                        <div class="admin-default-index">

                            <?php
                            echo GridView::widget([
                                'dataProvider' => $dataProvider,
                                'toolbar' => [
                                    [
                                        'content' =>
                                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['add'], ['class' => 'btn btn-success']) . ' ' .
                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                                            'data-pjax' => 10,
                                            'class' => 'btn btn-default',
                                            'title' => 'Reset Grid'
                                        ])
                                    ],
                                    '{toggleData}',
                                    '{export}',
                                ],
                                'panel' => [
                                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Товары</h3>',
                                    'type' => 'success',
                                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить товар', ['add'], ['class' => 'btn btn-success']),
                                    'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс выбранного', ['index'], ['class' => 'btn btn-info']) . ' ' .
                                    Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['delete-all'], ['class' => 'btn btn-warning', 'id' => 'deleteSel']),
                                    'footer' => false
                                ],
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn',
                                    ],
                                    'product_id',
                                    'title',
                                    'sku',
                                    'article',
                                    'brand.brand_name',
                                    'price',
                                    'special_price',
                                    'createdBy.username',
                                    'time_created:datetime',
                                    'updatedBy.username',
                                    'time_updated:datetime',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view} {edit} {delete}',
                                        'buttons' => ['edit' => function ($url, $model, $key) {
                                                return Html::a('Edit', $url);
                                            }],
                                    ],
                                    [
                                        'filter' => Products::getProductStatuses(),
                                        'attribute' => 'status',
                                        'format' => 'raw',
                                        'value' => function ($model, $key, $index, $column) {
                                            return Html::tag('span', Html::encode($model->getProductStatus($model->status)), ['class' => 'label status-' . $model->getProductStatus($model->status, true)]);
                                        }
                                            ],
                                        ],
                                        'resizableColumns' => false,
                                        'containerOptions' => ['id' => 'news-pjax-container', 'style' => 'overflow: auto'],
                                        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                                        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                                        'pjax' => true,
                                    ]);
                                    ?>

</div>
