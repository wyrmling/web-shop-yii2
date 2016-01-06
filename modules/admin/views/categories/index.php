<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];

echo Html::a('Добавить категорию', ['/admin/categories/add/', 'id' => 0], ['class'=>'btn btn-primary']);
echo buildTree($tree, 0);

function buildTree($cats, $parent_id)
{
    if (isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li>' . $cat['category_id'] . ' - ' . $cat['name']
                    . Html::a('[переименовать]', ['categories/edit', 'id' => $cat['category_id']])
                    . Html::a('[удалить]', ['categories/delete', 'id' => $cat['category_id']])
                    . Html::a('[добавить подкатегорию]', ['categories/add', 'id' => $cat['category_id']]);
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}