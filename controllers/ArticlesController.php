<?php

namespace app\controllers;

//use yii\web\Controller;
//use yii\data\Pagination;
use app\models\Articles;
use app\components\Controller;

class ArticlesController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRead($id = 0)
    {
        $article = Articles::findOne($id);
        return $this->render('read', ['id' => $id, 'model' => $article]);
    }
}
