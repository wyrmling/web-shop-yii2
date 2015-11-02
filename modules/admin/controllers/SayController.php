<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class SayController extends Controller
{   
    public function actionSay($message = 'Привет, фыв')
    {
        return $this->render('say', ['message' => $message]);
    }
}

