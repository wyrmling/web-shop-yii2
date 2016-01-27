<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Attributes;
use app\models\AttributesCategories;
use app\models\AttributesList;

class AttributesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
