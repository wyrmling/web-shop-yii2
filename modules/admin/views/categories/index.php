<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];

echo Html::a('Добавить категорию', ['/admin/categories/add/', 'id' => 0], ['class'=>'btn btn-success']);
echo buildTree($tree, 0);

function buildTree($cats, $parent_id)
{
    if (isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<br><li>' . $cat['category_id'] . ' - ' . $cat['name']
                    .' '. Html::a('переименовать', ['categories/edit', 'id' => $cat['category_id']], ['class'=>'btn btn-info'])
                    .' '. Html::a('удалить', ['categories/delete', 'id' => $cat['category_id']], ['class'=>'btn btn-warning'])
                    .' '. Html::a('добавить подкатегорию', ['categories/add', 'id' => $cat['category_id']], ['class'=>'btn btn-success']);
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}