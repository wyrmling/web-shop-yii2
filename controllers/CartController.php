<?php

namespace app\controllers;

use app\models\Cart;
use app\components\Controller;
use Yii;

class CartController extends Controller
{

    public function actionIndex($id)
    {
        Cart::addProduct((int)$id);
        return $this->redirect(Yii::$app->request->referrer);
    }

}
