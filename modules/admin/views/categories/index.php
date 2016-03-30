<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
?>
<div class="tree">

<?php
echo Html::a('+', ['/admin/categories/add/', 'id' => 0], ['title' => 'добавить категорию', 'class' => 'btn-category-add']);

echo buildTree(0, $tree, $quantities);
?>
</div>

    <?php
    function buildTree($start, $cats, $quant)
    {
        if (isset($cats[$start])) {
            $tree = '<ul>';
            foreach ($cats[$start] as $cat_id => $name) {
                if ($quant[$cat_id]['parent_category_id'] == 0) {
                    $stile_class = '<span><i class="icon-folder-open"></i>';
                } elseif (isset($cats[$cat_id])) {
                    $stile_class = '<span><i class="icon-minus-sign"></i>';
                } else {
                    $stile_class = '<span><i class="icon-leaf"></i>';
                }
                $tree .= '<li>' . $stile_class . $cat_id . ' - ' . $name . ' (' . $quant[$cat_id]['quantity_visible'] . ') ' . ' (' . $quant[$cat_id]['quantity_invisible'] . ') '
                        . Html::a('R', ['categories/edit', 'id' => $cat_id], ['title' => 'переименовать категорию', 'class' => 'btn-category-edit'])
                        . Html::a('-', ['categories/delete', 'id' => $cat_id], ['title' => 'удалить категорию', 'class' => 'btn-category-delete'])
                        . Html::a('+', ['categories/add', 'id' => $cat_id], ['title' => 'добавить категорию', 'class' => 'btn-category-add'])
                        . Html::a('L', ['attributes/list', 'id' => $cat_id], ['title' => 'список атрибутов категории', 'class' => 'btn-category-list'])
                        . '</span>';
                $tree .= buildTree($cat_id, $cats, $quant);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
            return $tree;
        }
    }
    ?>

