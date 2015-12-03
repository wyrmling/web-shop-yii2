<?php
use dosamigos\ckeditor\CKEditorInline;
use yii\data\ActiveDataProvider;
use app\models\Article;
use yii\grid\GridView;
use yii\bootstrap\Button;
use yii\bootstrap\Html;
?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>123
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.<br>

        <?= Html::a('Создать', '/admin/article/add', ['class'=>'btn btn-primary'])

        ?>
        <?php

        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'article_id',
                'title',
                'description',
                'user.username',
                'created_time:datetime',
                // в базе данных не datetime а timestamp
                ['class' => 'yii\grid\ActionColumn']
            ]
        ]);
        ?>

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
