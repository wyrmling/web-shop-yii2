<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView
?>
<div class="post">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= HtmlPurifier::process($model->description) ?>  
    <br><br><?= Html::encode($model->time_created) ?>
    <br><br><?= HtmlPurifier::process($model->content) ?>
    <br><br>
</div>

<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'title',
        'description:html',
        'time_created:timestamp',
        'content:html',
        
    ],
]);