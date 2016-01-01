<?php


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
            $tree .= '<li>'.$cat['category_id'].'-'.$cat['name'];
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
