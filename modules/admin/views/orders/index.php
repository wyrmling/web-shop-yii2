<?php

use app\models\Orders;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
?>

<div class="admin-default-index">

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']) . ' ' .
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
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Заказы</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить заказ', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс выбранного', ['index'], ['class' => 'btn btn-info']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['delete-all'], ['class' => 'btn btn-warning', 'id' => 'deleteSel']),
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            ['attribute' => 'order_id', 'label' => 'ID заказа'],
            ['attribute' => 'username', 'label' => 'Пользователь'],
            ['attribute' => 'entered_name', 'label' => 'Имя'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => 'order-detail',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            ['attribute' => 'user_phone_number', 'label' => 'Номер телефона'],
            ['attribute' => 'total_sum', 'label' => 'Зафиксированная сумма'],
            ['attribute' => 'time_ordered', 'label' => 'Дата/Время заказа'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {edit} {delete}',
                'buttons' => ['edit' => function ($url, $model, $key) {
                        return Html::a('Edit', $url);
                    }],
            ],
            [
                'filter' => Orders::getOrderStatuses(),
                'attribute' => 'status',
                'label' => 'Статус заказа',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::tag('span', Html::encode(Orders::getOrderStatus($model['status'])), ['class' => 'label status-' . Orders::getOrderStatus($model['status'], true)]);
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

<div>
    <b>Зафиксированная сумма</b> - сумма заказа, которая внесена в базу данных:
    <br>
    изначально равна сумме на момент отправки заказа покупателем,
    <br>
    может быть заменена менеджером на актуальную сумму кнопкой "Зафиксировать сумму"
</div>