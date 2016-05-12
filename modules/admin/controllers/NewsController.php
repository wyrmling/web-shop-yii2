<?php

namespace app\modules\admin\controllers;

use Yii;
use app\components\Controller;
use app\models\News;

class NewsController extends Controller
{

    public function actionIndex() {
        $news = new News(['scenario' => News::SCENARIO_FILTER]);
        return $this->render('index', [
            'dataProvider' => $news->search(Yii::$app->request->get()),
            'filterModel' => $news,
        ]);
    }

    public function actionCreate() {
        $news = (new News)->loadDefaultValues();

        if ($news->load(Yii::$app->request->post()) && $news->validate()) {
            if ($news->save()) {
                return $this->redirect('/admin/news/edit/' . $news->news_id);
            }
        } else {
            return $this->render('create', ['model' => $news]);
        }
    }

    public function actionEdit($id)
    {
        $news = News::findOne(['news_id' => $id]);

//            if ($news) $user = User::findOne($news->user_id);

        if ($news->load(Yii::$app->request->post()) && $news->validate()) {
            $results = $news->save();
            return $this->render('edit', ['model' => $news, 'type' => 'create', 'result' => $results]);
        } else {
            return $this->render('edit', ['model' => $news, 'type' => 'edit']);
        }
    }

    public function actionDelete($id) {
        if (News::deleteAll(['news_id' => $id]))
            return $this->redirect('/admin/news');
    }

    public function actionMultipleDelete() {
        if (News::deleteAll(['news_id' => Yii::$app->request->post('ids')])) {
            echo json_encode('ok');
        } else {
            echo json_encode('nok');
        }
    }

}