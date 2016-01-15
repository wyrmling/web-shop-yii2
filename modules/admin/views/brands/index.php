<?php

use yii\data\ActiveDataProvider;
use app\models\Brands;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];

$query = Brands::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
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
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Бренды</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить бренд', ['add'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс выбранного', ['index'], ['class' => 'btn btn-info']) . ' ' .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['delete-all'], ['class' => 'btn btn-warning', 'id' => 'deleteSel']),
            'footer' => false
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'brand_id',
            'brand_name',
            'discount',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {edit} {delete}',
                'buttons' => ['edit' => function ($url, $model, $key) {
                    return Html::a('Edit', $url);
                }],
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