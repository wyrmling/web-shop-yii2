<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;

class ArticlesController extends Controller {

    public function actionIndex() {
    //  список статей
        return $this->render('index');
    }

    public function actionAdd() {
        $articles = new Articles;

        if ($articles->load(Yii::$app->request->post()) && $articles->validate()) {
            $res = $articles->save();
            return $this->render('update', ['model' => $articles, 'type' => 'edit']);
        } else {
            return $this->render('update', ['model' => $articles, 'type' => 'create']);
        }
    //  если статья уже есть -> страница редактирования,
    //  иначе -> страница добавления новости
    }

    public function actionUpdate($id) {
        if (!empty($id)) {
            $articles = Articles::find()
                    ->where(['article_id' => $id])
                    ->one();
        // по id находим статью
            if ($articles->load(Yii::$app->request->post()) && $articles->validate()) {
                $res = $articles->save();
                return $this->render('update', ['model' => $articles, 'type' => 'create']);
            } else {
                return $this->render('update', ['model' => $articles, 'type' => 'edit']);
            }
        }
    //  если статья уже есть -> страница редактирования,
    //  иначе -> страница добавления новости
    }

    public function actionDelete($id) {
        $articles = new Articles;
        if (!empty($id)) {
        // по id находим статью
            $articles = Articles::find()
                    ->where(['article_id' => $id])
                    ->one();
        }
        // удаляем статью с найденным id   
        $res = $articles->delete();
        // перезагружаем список статей
        return $this->render('index');
    }

}
