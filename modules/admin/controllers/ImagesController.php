<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Images;
use yii\web\UploadedFile;
use app\models\UploadFiles;

class ImagesController extends Controller
{

    public function actionIndex()
    {
        $model_1 = new UploadFiles(['scenario' => UploadFiles::SCENARIO_DOWNLOAD_IMAGES]);

        $model_2 = new Images;

        if (Yii::$app->request->isPost) {
            $model_1->downloadFile = UploadedFile::getInstance($model_1, 'downloadFile');
            if ($model_1->upload()) {

                if ($model_2->load(Yii::$app->request->post()) && $model_2->validate()) {
                    $model_2->save();
                }
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('index', [
                'model_1' => $model_1,
                'model_2' => $model_2,
        ]);
    }

}
