<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['/articles']];
$this->params['breadcrumbs'][] = Html::encode($model->title);

?>

<div class="post">
    <h2><?= Html::encode($model->title) ?></h2>
    <br>
    <?= HtmlPurifier::process($model->description) ?>
    <br><br>
    <?= Html::encode($model->time_created) ?>
    <br>
    <?= Html::encode($model->createdBy->username) ?>
    <br><br>
    <?= HtmlPurifier::process($model->content) ?>
    <br><br>

</div>