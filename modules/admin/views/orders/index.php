<?php

use app\models\Orders;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];

// TODO: move code to .js file
$this->registerJs("
    function multi_delete() {
        var selIds = $('#grid').yiiGridView('getSelectedRows');
        $.ajax({
            type: 'POST',
            url: 'multiple-delete/',
            data: {ids: selIds},
            success: function(data) {
                if (JSON.parse(data) === 'ok') {
                    $.pjax.reload({container: '#grid-pjax'});
                }
            }
        });
    }", \yii\web\View::POS_END);
?>

<div class="admin-default-index">
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'toolbar' => [
        [
            'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['add'], ['class' => 'btn btn-success']) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 10, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
        ],
        '{toggleData}',
        '{export}',
    ],
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Заказы</h3>',
        'type' => 'success',
        'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить заказ', ['add'], ['class' => 'btn btn-success']),
        'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сбросить', ['index'], ['class' => 'btn btn-info']) . ' ' .
            Html::button('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['class' => 'btn btn-warning', 'id' => 'multi_delete', 'onclick' => 'multi_delete()']),
    ],
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
        ],
        'order_id',
        'user.username',
        'entered_name',
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detailUrl' => 'orders/order-detail',
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        'user_phone_number',
        ['attribute' => 'total_sum', 'label' => 'Зафиксированная<br>сумма', 'encodeLabel' => false],
        'time_ordered',
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
    'options' => ['id' => 'grid'],
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