<?php

use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;

?>
<div class="post">
    <?= Html::a('<h2>'. Html::encode($model->title) .'</h2>', ['articles/read', 'id' => $model->article_id]) ?>
    <?= HtmlPurifier::process($model->description) ?>
    <br>
    <?= Html::encode($model->time_created) ?>
    <br>
    <?= Html::encode($model->createdBy->username) ?>
</div>

