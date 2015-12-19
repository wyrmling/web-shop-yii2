<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Articles;

class ArticlesController extends \yii\web\Controller
    {

    public function actionIndex()
    {
        $query = Articles::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $articles = $query->orderBy('article_id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index', [
                    'articles' => $articles,
                    'pagination' => $pagination,
        ]);
    }

    }
