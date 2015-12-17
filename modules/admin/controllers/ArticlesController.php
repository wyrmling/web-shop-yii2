<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;

class ArticlesController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        //$articles = new Articles;
        $articles = (new Articles)->loadDefaultValues();

        if ($articles->load(Yii::$app->request->post()) && $articles->validate()) {
            $res = $articles->save();
            return $this->redirect('/admin/articles/edit/' . $articles->article_id);
        } else {
            return $this->render('create', ['model' => $articles, 'type' => 'create']);
        }
    }

    public function actionEdit($id)
    {
        if (!empty($id)) {
            $articles = Articles::find()
                ->where(['article_id' => $id])
                ->one();

            if ($articles->load(Yii::$app->request->post()) && $articles->validate()) {
                $results = $articles->save();
                return $this->render('edit', ['model' => $articles, 'type' => 'create', 'result' => $results]);
            } else {
                return $this->render('edit', ['model' => $articles, 'type' => 'edit']);
            }
        }
    }

    public function actionDelete($id) {
        if (Articles::deleteAll(['article_id' => $id]))
            return $this->redirect('/admin/articles');
    }

}