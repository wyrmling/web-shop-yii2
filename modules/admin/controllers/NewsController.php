<?php

namespace app\modules\admin\controllers;

//use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex()
    {
//        return $this->render('index');
//        $message = var_export(\Yii::$app->request->get());
        return $this->render('index');
    }

    public function actionSay()
    {
        return $this->render('index');
    }
}
