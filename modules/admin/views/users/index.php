<?php
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Users;
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Users';

?>

<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
        <?php

        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'user_id',
                'username',
                'password',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действия',
                    'headerOptions' => ['width' => '80'],
                    'template' => '{view} {update} {delete} {link}',
                    'buttons' => [
                        'update' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-screenshot"></span>', $url);
                        },
                        'link' => function ($url) {
                            return Html::a('Действие', $url);
                        },
                    ],
                ],
                [
                    'attribute'=>'is_active',
                    'filter'=>array('y'=>'Активно','n'=>'Не активно'),
                ],
            ],
        ]);

        foreach ($users as $k => $user) {
            echo $user->username.'<br>';
        }
        ?>
</div>
