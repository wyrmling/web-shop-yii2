<?php

use dosamigos\ckeditor\CKEditorInline;
use yii\data\ActiveDataProvider;
use app\models\Articles;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];

$query = Articles::find();
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
        ]);
// join with relation `user` that is a relation to the table `users`
// and set the table alias to be `Имя автора`
$query->joinWith(['user' => function($query) {
        $query->from(['user' => 'users']);
    }]);
// enable sorting for the related column
        $dataProvider->sort->attributes['user.username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
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
                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Создать статью', ['create'], ['class' => 'btn btn-success']),
                'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Сброс выбранного', ['index'], ['class' => 'btn btn-info']) . ' ' .
                Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['delete-all'], ['class' => 'btn btn-warning', 'id' => 'deleteSel']),
                'footer' => false
            ],
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                ],
                'article_id',
                'title',
                'description',
                'user.username',
                'time_created:datetime',
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
                            'resizableColumns' => false,
                            'containerOptions' => ['id' => 'news-pjax-container', 'style' => 'overflow: auto'],
                            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                            'pjax' => true,
                        ]);
                        ?>
                        </p>
</div>
