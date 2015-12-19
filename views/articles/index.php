<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Статьи</h1>
<ul>
            <?php foreach ($articles as $article): ?>
        <li><b>
            <?= Html::encode("{$article->article_id} ({$article->title})") ?>:
            </b>
        <?= $article->description ?>
        </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>