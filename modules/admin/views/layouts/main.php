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
    <?php $this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<!--    <link rel="shortcut icon" href="favicon.ico">-->
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
        'route' => Yii::$app->controller->module->id . '/' . Yii::$app->controller->id,
        'encodeLabels' => false,
        'activateParents' => true,
        'items' => [
//            ['label' => '<span class="glyphicon glyphicon-home"></span> Home', 'url' => [Yii::$app->homeUrl]],
            ['label' => '<i class="fa fa-shopping-cart"></i> Orders', 'url' => ['/admin/orders']],
            ['label' => '<i class="fa fa-newspaper-o"></i> News', 'url' => ['/admin/news']],
            ['label' => '<i class="fa fa-leanpub"></i> Articles', 'url' => ['/admin/articles']],
            ['label' => 'Categories', 'url' => ['/admin/categories']],
            ['label' => 'Attributes', 'url' => ['/admin/attributes']],
            ['label' => 'Brands', 'url' => ['/admin/brands']],
            ['label' => 'Products', 'url' => ['/admin/products']],
            ['label' => '<i class="fa fa-cogs"></i> Tools', 'items' => [
                ['label' => '<i class="fa fa-user"></i> Users', 'url' => ['/admin/users']],
                ['label' => '<i class="fa fa-database"></i> DB', 'url' => ['/admin/base']],
            ]]
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
        <?=
            Breadcrumbs::widget([
                'homeLink' => [
                    'label' => Yii::t('yii', 'Home'),
                    'url' => Yii::$app->homeUrl,
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
        ?>
        <?= $content ?>
    </div>
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
