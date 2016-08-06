<?php

namespace app\models;

use Yii;
use paulzi\adjacencyList\AdjacencyListBehavior;

class AltCategories extends Categories
{

    public function behaviors() {
        return [
            [
                'class' => AdjacencyListBehavior::className(),
                'parentAttribute' => 'parent_category_id',
                'sortable' => false,
            ],
        ];
    }

}