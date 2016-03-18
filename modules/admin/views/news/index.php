<?php
use dosamigos\ckeditor\CKEditorInline;
use yii\data\ActiveDataProvider;
use app\models\News;
use kartik\grid\GridView;
use yii\bootstrap\Html;

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
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.<br>

        <?= Html::a('Создать', '/admin/news/create', ['class'=>'btn btn-primary']) ?>
        <?php

        echo GridView::widget([
            'dataProvider' => $dataProvider,
//            'toolbar' => [
//                [
//                    'content' =>
//                        Html::button('<i class="glyphicon glyphicon-plus"></i>', [
//                            'type' => 'button',
//                            'title' => Yii::t('app', 'Add Book'),
//                            'class' => 'btn btn-success'
//                        ]) . ' ' .
//                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
//                            'class' => 'btn btn-default',
//                            'title' => Yii::t('app', 'Reset Grid')
//                        ]),
//                ],
//            ],
            'toolbar' => [
                [
                    'content' =>
                        Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                            'type' => 'button',
                            'title' => 'Add Book',
                            'class' => 'btn btn-success',
                            'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
                        ]) . ' '.
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
                            'data-pjax' => 10,
                            'class' => 'btn btn-default',
                            'title' => 'Reset Grid'
                        ])
                ],
//                '{export}',
//                '{toggleData}',
            ],
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Новости</h3>',
                'type' => 'success',
                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Создать новость', ['create'], ['class' => 'btn btn-success']),
                'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']) . ' ' .
                           Html::button('<i class="glyphicon glyphicon-trash"></i> Удалить выбранные', ['class' => 'btn btn-warning', 'id' => 'multi_delete', 'onclick' => 'multi_delete()']),
            ],
            'columns' => [
                [
                    'class' => '\kartik\grid\RadioColumn',
                ],
                [
                    'class' => '\kartik\grid\CheckboxColumn',
                ],
                'news_id',
                'title',
                'description',
                'user.username',
                'time_created:datetime',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {edit} {delete}',
                    'buttons' => ['edit' => function ($url, $model, $key) { return Html::a('Edit', $url);}],
                ],
                [
                    'filter' => News::getStatuses(),
                    'attribute' => 'news_status',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) {
                        /** @var \yii\grid\DataColumn $column */
//                        $value = $model->{$column->attribute};
//                        switch ($value) {
//                            case News::VISIBLE:
//                                $class = 'visible';
//                                break;
//                            case News::HIDDEN:
//                                $class = 'hidden';
//                                break;
////                            case User::STATUS_BLOCKED:
//                            default:
//                                $class = 'default';
//                        };
                        return Html::tag('span', Html::encode($model->getStatus($model->news_status)), ['class' => 'label status-' . $model->getStatus($model->news_status, true)]);
//                        return $value === null ? $column->grid->emptyCell : $html;
                    }
                ],
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'attribute' => 'news_status',
                    'vAlign' => 'middle'
                ],
//                [
//                    'filter' => News::getStatuses(),
//                    'attribute' => 'news_status',
//                    'format' => 'raw',
//                    'value' => function ($model, $key, $index, $column) {
////                        return Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label status-' . $model->news_status]);
//                        return Html::checkbox($model->news_status, $model->news_status);
//                    }
//                ],
            ],
            'options' => ['id' => 'grid'],
            'resizableColumns' => false,
            'containerOptions' => ['id' => 'news-pjax-container', 'style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'pjax' => true,
            // set your toolbar
            // set export properties
//            'export'=>[
//                'fontAwesome'=>true
//            ],
        ]);
        ?>

    </p>
</div>