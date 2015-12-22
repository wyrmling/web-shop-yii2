<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$url = Url::to(['articles/read/', 'id' => "$model->article_id"]);
?>
<div class="post">
    <a href="<?= $url ?>"><h2><?= Html::encode($model->title) ?></h2></a>
<?= HtmlPurifier::process($model->description) ?>  
    <br><?= Html::encode($model->time_created) ?>
</div>

