<?php

namespace app\controllers;

use yii\web\Controller;

class TodoController extends Controller
{
    public function actionList()
    {
        return $this->render('list', ['name' => 'Default']);
    }

    public function actionAdd()
    {
        return $this->render('add');
    }
}

