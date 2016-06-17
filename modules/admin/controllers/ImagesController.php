<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Files;
use yii\web\UploadedFile;

class ImagesController extends Controller
{

    public function actionIndex()
    {
        $files = new Files(['scenario' => Files::SCENARIO_IMAGE]);

        if (Yii::$app->request->isPost) {
            if ($files->load(Yii::$app->request->post()) && $files->validate()) {
                $files->save();
            }
            $files->file = UploadedFile::getInstance($files, 'downloadFile');
            if ($files->upload()) {

//                if ($files->load(Yii::$app->request->post()) && $files->validate()) {
//                    $files->save();
//                }
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('index', [
            'model' => $files,
        ]);
    }

}