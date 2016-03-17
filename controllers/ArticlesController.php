<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Articles;

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