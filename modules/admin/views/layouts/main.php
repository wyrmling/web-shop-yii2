<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '&larr; back to main',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
        'options' => ['class' => 'nav navbar-nav'],
        'items' => [
            ['label' => '&larr; back to main', 'url' => [Yii::$app->homeUrl]],
            ['label' => 'News', 'url' => ['/admin/news/index']],
            ['label' => 'Articles', 'url' => ['/admin/articles/index']],
            ['label' => 'Products', 'url' => ['/admin/products/index']],
            ['label' => 'Todo', 'url' => ['/admin/todo/index']],
//            Yii::$app->user->isGuest ?
//                ['label' => 'Login', 'url' => ['/site/login']] :
//                [
//                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
//                    'url' => ['/site/logout'],
//                    'linkOptions' => ['data-method' => 'post']
//                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<div class="wrap">
    <!--<div class="container">-->
<?php
    Modal::begin([
        'header' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me'],
    ]);
    echo 'Say hello...';
    Modal::end();
?>
    <!--</div>-->
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
