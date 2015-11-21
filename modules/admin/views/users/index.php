<?php
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\DbUser;

//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Users';

?>

<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
        <?php

        $dataProvider = new ActiveDataProvider([
            'query' => DbUser::find(),
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
            ]
        ]);

        foreach ($users as $k => $user) {
            echo $user->username.'<br>';
        }
        ?>
</div>
