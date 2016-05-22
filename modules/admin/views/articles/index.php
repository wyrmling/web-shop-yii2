<?php

// use yii\data\ActiveDataProvider;
use app\models\Articles;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];

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
        'filterModel' => $filterModel,
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success', 'data-pjax' => 0]) . ' ' .
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
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Статьи</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить статью', ['create'], ['class' => 'btn btn-success', 'data-pjax' => 0]),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сбросить', ['index'], ['class' => 'btn btn-info']) . ' ' .
            Html::button('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['class' => 'btn btn-warning', 'id' => 'multi_delete', 'onclick' => 'multi_delete()']),
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'article_id',
            'title',
            'description',
            'createdBy.username',
            [
//                'attribute' => 'time_created:datetime',
                'attribute' => 'time_created',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'convertFormat' => true,
//                    'useWithAddon' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y.m.d'],
                        'separator' => '.',
//                        'opens' => 'left'
                    ]
                ],
                'format' => ['date', 'php:Y.m.d H:i:s']
//                'filterType' => GridView::FILTER_DATETIME,
            ],
//        'time_created:datetime',
//        'updatedBy.username',
//            'time_updated:datetime',
//            'time_updated',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {edit} {delete}',
                'buttons' => ['edit' => function ($url, $model, $key) {
                        return Html::a('Edit', $url);
                    }],
            ],
            [
                'filter' => Articles::articleFilterList(),
                'attribute' => 'article_status',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::tag('span', Html::encode($model->getArticleStatus($model->article_status)), ['class' => 'label status-' . $model->getArticleStatus($model->article_status, true)]);
                }
              ],
              [
                  'filter' => Articles::commentsFilterList(),
                  'attribute' => 'comments_status',
                  'format' => 'raw',
                  'value' => function ($model, $key, $index, $column) {
                      return Html::tag('span', Html::encode($model->getCommentsStatus($model->comments_status)), ['class' => 'label status-' . $model->getCommentsStatus($model->comments_status, true)]);
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