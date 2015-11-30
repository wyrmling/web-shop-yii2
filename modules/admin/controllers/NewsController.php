<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\News;

class NewsController extends Controller
{
    public function actionIndex()
    {
//        return $this->render('index');
//        $message = var_export(\Yii::$app->request->get());
        return $this->render('index');
    }

    public function actionAdd()
    {
        $news = new News;

        if ($news->load(Yii::$app->request->post()) && $news->validate()) {
            $res = $news->save();
            return $this->render('update', ['model' => $news, 'type' => 'edit']);
        } else {
            return $this->render('update', ['model' => $news, 'type' => 'create']);
        }

            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

//            return $this->render('entry-confirm', ['model' => $news]);
//        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
//            return $this->render('update', ['model' => $news]);
//        }
    }

    public function actionUpdate($id)
    {
        if (!empty($id)) {
//            $news = (new News)
//                    ->where(['=', 'news_id', $id])
//                    ->one();
            $news = News::find()
                ->where(['news_id' => $id])
                ->one();

            if ($news->load(Yii::$app->request->post()) && $news->validate()) {
                $res = $news->save();
                return $this->render('update', ['model' => $news, 'type' => 'create']);
            } else {
                return $this->render('update', ['model' => $news, 'type' => 'edit']);
            }
        }

            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

//            return $this->render('entry-confirm', ['model' => $news]);
//        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
//            return $this->render('update', ['model' => $news]);
//        }
    }

}
