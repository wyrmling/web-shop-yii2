<?php

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];

echo buildTree($tree, 0);

//foreach ($categories as $v) {
//    print_r($v);
//    $array[$v['category_id']] = $v['parent_category_id'];
//    echo '<br>';
//}

function buildTree($cats, $parent_id)
{
    if (isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<br><li>' . $cat['category_id'] . '-' . $cat['name']
                    . '<a href=' . Url::to(['/admin/product-categories-list/edit/', 'id' => $cat['category_id']]) . '> [изменить]</a>'
                    . '<a href=' . Url::to(['/admin/product-categories-list/delete/', 'id' => $cat['category_id']]) . '> [удалить]</a>'
                    . '<a href=' . Url::to(['/admin/product-categories-list/add/', 'id' => $cat['category_id']]) . '> [добавить подкатегорию]</a>';
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
