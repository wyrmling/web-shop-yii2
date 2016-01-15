<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];

echo Html::a('Добавить категорию', ['/admin/categories/add/', 'id' => 0], ['class'=>'btn btn-success']);

echo buildTree(0, $tree);

function buildTree($start, $cats)
{
    if (isset($cats[$start])) {
        $tree = '<ul>';
        foreach ($cats[$start] as $cat_id => $name) {
            $tree .= '<li>' . $cat_id . ' - ' . $name
                . Html::a('[переименовать]', ['categories/edit', 'id' => $cat_id])
                . Html::a('[удалить]', ['categories/delete', 'id' => $cat_id])
                . Html::a('[добавить подкатегорию]', ['categories/add', 'id' => $cat_id]);
            $tree .= buildTree($cat_id, $cats);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}