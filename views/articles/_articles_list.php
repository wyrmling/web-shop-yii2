<?php

use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;

?>
<div class="post">
    <a href="<?= Url::to(['articles/read/', 'id' => "$model->article_id"]); ?>"><h2><?= Html::encode($model->title) ?></h2></a>
    <?= HtmlPurifier::process($model->description) ?>  
    <br>
    <?= Html::encode($model->time_created) ?>
    <br>
    <?= Html::encode($model->user->username) ?>
</div>

