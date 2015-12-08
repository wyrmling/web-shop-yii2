<?php

use dosamigos\ckeditor\CKEditorInline;
use yii\data\ActiveDataProvider;
use app\models\Articles;
use yii\grid\GridView;
use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
?>
<div class="admin-default-index">
    <!-- <h1><?= $this->context->action->uniqueId ?></h1> -->
    <p>
        <!-- This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.<br> -->

        <?= Html::a('Создать', '/admin/articles/create', ['class' => 'btn btn-primary'])
        ?>
        <?php
        $query = Articles::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        // join with relation `user` that is a relation to the table `users`
// and set the table alias to be `автор`
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
                    'columns' => [
                        'article_id',
                        'title',
                        'description',
                        'user.username',
                        'created_time:timestamp',
                        'changed_time:timestamp',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {edit} {delete}',
                            'buttons' => ['edit' => function ($url, $model, $key) {
                                    return Html::a('Edit', $url);
                                }],
                        ],
                        [
                            'filter' => Articles::getStatuses(),
                            'attribute' => 'article_status',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $column) {
                                /** @var \yii\grid\DataColumn $column */
                                $value = $model->{$column->attribute};
                                switch ($value) {
                                    case Articles::VISIBLE:
                                        $class = 'visible';
                                        break;
                                    case Articles::HIDDEN:
                                        $class = 'hidden';
                                        break;
//                            case User::STATUS_BLOCKED:
                                    default:
                                        $class = 'default';
                                };
                                $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label status-' . $class]);
                                return $value === null ? $column->grid->emptyCell : $html;
                            }
                                ],
                                [
                                    'filter' => Articles::getCommetsStatuses(),
                                    'attribute' => 'comments_status',
                                    'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        /** @var \yii\grid\DataColumn $column */
                                        $value = $model->{$column->attribute};
                                        switch ($value) {
                                            case Articles::YES:
                                                $class = 'visible';
                                                break;
                                            case Articles::NO:
                                                $class = 'hidden';
                                                break;
//                            case User::STATUS_BLOCKED:
                                            default:
                                                $class = 'default';
                                        };
                                        $html = Html::tag('span', Html::encode($model->getCommentsStatusName()), ['class' => 'label status-' . $class]);
                                        return $value === null ? $column->grid->emptyCell : $html;
                                    }
                                        ],
                                    ]
                                ]);
                                ?>
                                <?php //echo Html::a('update', array('site/save', 'id'=>$post->id)); ?>

                                <?php CKEditorInline::begin(['preset' => 'basic']); ?>
                                Этот текст типа можно редактировать
                        <?php CKEditorInline::end(); ?>
                                321
                            </p>
                            <p>
                                You may customize this page by editing the following file:<br>
                                <code><?= __FILE__ ?></code>
    </p>
</div>
