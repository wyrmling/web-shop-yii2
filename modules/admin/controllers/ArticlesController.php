<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;

class ArticlesController extends Controller
{
    public function actionIndex()
    {
//        return $this->render('index');
//        $message = var_export(\Yii::$app->request->get());
        return $this->render('index');
    }

    public function actionAdd()
    {
        $articles = new Article;

        if ($articles->load(Yii::$app->request->post()) && $articles->validate()) {
            $res = $articles->save();
            return $this->render('update', ['model' => $articles, 'type' => 'edit']);
        } else {
            return $this->render('update', ['model' => $articles, 'type' => 'create']);
        }

            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

//            return $this->render('entry-confirm', ['model' => $articles]);
//        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
//            return $this->render('update', ['model' => $articles]);
//        }
    }

    public function actionUpdate($id)
    {
        if (!empty($id)) {
//            $articles = (new Articles)
//                    ->where(['=', 'article_id', $id])
//                    ->one();
            $articles = Articles::find()
                ->where(['article_id' => $id])
                ->one();

            if ($articles->load(Yii::$articles->request->post()) && $articles->validate()) {
                $res = $articles->save();
                return $this->render('update', ['model' => $articles, 'type' => 'create']);
            } else {
                return $this->render('update', ['model' => $articles, 'type' => 'edit']);
            }
        }

            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

//            return $this->render('entry-confirm', ['model' => $articles]);
//        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
//            return $this->render('update', ['model' => $articles]);
//        }
    }

}
