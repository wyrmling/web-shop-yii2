<?php

namespace app\controllers;

class ProductsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
