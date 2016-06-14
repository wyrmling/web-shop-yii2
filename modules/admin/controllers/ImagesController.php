<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Images;
use yii\web\UploadedFile;

class ImagesController extends Controller
{

    public function actionIndex()
    {
        $model = new Images();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}
