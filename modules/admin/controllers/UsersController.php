<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\DbUser;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users = DbUser::find()->all();
//        return $this->render('index');
//        $message = var_export(\Yii::$app->request->get());
        return $this->render('index', ['users' => $users]);
    }

    public function actionSay()
    {
        return $this->render('index');
    }
}
