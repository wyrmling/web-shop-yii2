<?php
use yii\data\ActiveDataProvider;
use app\models\Articles;
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['/articles']];
$this->params['breadcrumbs'][] = 'ID статьи = ' . $id;

$dataProvider = new ActiveDataProvider([
    'query' => Articles::find()->where(['article_id' => $id]),
        ]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_article_read',
]);