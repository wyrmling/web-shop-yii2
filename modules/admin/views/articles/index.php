<?php

use yii\data\ActiveDataProvider;
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

$query = Articles::find()
    ->joinWith(['createdBy']);
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
$dataProvider->sort->attributes['createdBy.username'] = [
    'asc' => ['createdBy.username' => SORT_ASC],
    'desc' => ['createdBy.username' => SORT_DESC],
];

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
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Статьи</h3>',
        'type' => 'success',
        'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить статью', ['create'], ['class' => 'btn btn-success']),
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
        'time_created:datetime',
//        'updatedBy.username',
        'time_updated:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {edit} {delete}',
            'buttons' => ['edit' => function ($url, $model, $key) {
                return Html::a('Edit', $url);
            }],
        ],
        [
            'filter' => Articles::getArticleStatuses(),
            'attribute' => 'article_status',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                return Html::tag('span', Html::encode($model->getArticleStatus($model->article_status)), ['class' => 'label status-' . $model->getArticleStatus($model->article_status, true)]);
            }
        ],
        [
            'filter' => Articles::getArticleStatuses(),
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