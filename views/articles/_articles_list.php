<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
//use yii\helpers\Url

?>
<div class="post">
    <a href="/articles/<?= $model->article_id ?>"><h2><?= Html::encode($model->title) ?></h2></a>
<?= HtmlPurifier::process($model->description) ?>  
    <br><?= Html::encode($model->time_created) ?>
</div>

