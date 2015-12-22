<?php

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Articles;
//se yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['/articles']];
?>
<h1>Статьи</h1>

<?php
$dataProvider = new ActiveDataProvider([
    'query' => Articles::find(),
    'pagination' => [
        'pageSize' => 3,
    ],
    'sort' => [
        'defaultOrder' => [
            'time_created' => SORT_DESC,
            'title' => SORT_ASC,
        ]
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_articles_list',
]);