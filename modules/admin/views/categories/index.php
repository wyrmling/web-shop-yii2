<?php

use yii\helpers\Html;
use app\models\Categories;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];

echo Html::a('Добавить категорию', ['/admin/categories/add/', 'id' => 0], ['class' => 'btn btn-success']);

echo buildTree(0, $tree, $quantities);

function buildTree($start, $cats, $quant)
{
    if (isset($cats[$start])) {
        $tree = '<ul>';
        foreach ($cats[$start] as $cat_id => $name) {
            $tree .= '<li>' . $cat_id . ' - ' . $name . ' (' . $quant[$cat_id]['quantity_visible'] . ') ' . ' (' . $quant[$cat_id]['quantity_invisible'] . ') '
                    . Html::a('[переименовать]', ['categories/edit', 'id' => $cat_id])
                    . Html::a('[удалить]', ['categories/delete', 'id' => $cat_id])
                    . Html::a('[добавить подкатегорию]', ['categories/add', 'id' => $cat_id]);
            $tree .= buildTree($cat_id, $cats, $quant);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}