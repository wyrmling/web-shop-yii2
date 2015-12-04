<?php
use dosamigos\ckeditor\CKEditorInline;
use yii\data\ActiveDataProvider;
use app\models\News;
use yii\grid\GridView;
use yii\bootstrap\Html;
?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>123
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.<br>

        <?= Html::a('Создать', '/admin/news/add', ['class'=>'btn btn-primary'])

        ?>
        <?php

        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'news_id',
                'title',
                'description',
                'user.username',
                'time_created:datetime',
                ['class' => 'yii\grid\ActionColumn']
            ]
        ]);
        ?>
        <?php //echo Html::a('update', array('site/save', 'id'=>$post->id)); ?>

<?php CKEditorInline::begin(['preset' => 'basic']);?>
        Этот текст типа можно редактировать
<?php CKEditorInline::end();?>
321
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
