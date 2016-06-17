<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\Files;

class ImagesController extends Controller
{

    /** 1. saving file (random name)
     *     DB
     *  2. DB
     *     saving file (with DB keys)
     */
    public function actionIndex()
    {
        $files = new Files(['scenario' => Files::SCENARIO_IMAGE]);

        if (Yii::$app->request->isPost) {
            if ($files->load(Yii::$app->request->post()) && $files->validate()) {
                $files->save();

                if ($files->upload()) {

    //                if ($files->load(Yii::$app->request->post()) && $files->validate()) {
    //                    $files->save();
    //                }
                    // file is uploaded successfully
                    return;
                }
            }
        }

        return $this->render('index', [
            'model' => $files,
        ]);
    }

}