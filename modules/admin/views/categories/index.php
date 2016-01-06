<?php

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];

echo buildTree($tree, 0);

function buildTree($cats, $parent_id)
{
    if (isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li>' . $cat['category_id'] . ' - ' . $cat['name']
                    . '<a href=' . Url::to(['/admin/categories/edit/', 'id' => $cat['category_id']]) . '> [переименовать]</a>'
                    . '<a href=' . Url::to(['/admin/categories/delete/', 'id' => $cat['category_id']]) . '> [удалить]</a>'
                    . '<a href=' . Url::to(['/admin/categories/add/', 'id' => $cat['category_id']]) . '> [добавить подкатегорию]</a>';
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}

echo '<a href=' . Url::to(['/admin/categories/add/', 'id' => 0]) . '> [добавить категорию]</a>';
