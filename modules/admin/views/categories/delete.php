<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Удаление категории ' . $model->category_id . ' - "' . $model->name . '"';

if (isset($tree[$model->category_id])) {
    $addition = 'и все ее подкатегории';
    echo 'и всех ее подкатегорий:';
} else {
    $addition = '';
}

echo buildTree($tree, $model->category_id);

function buildTree($cats, $parent_id)
{
    if (isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li>' . $cat['category_id'] . ' - ' . $cat['name'];
            $tree .= buildTree($cats, $cat['category_id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
?>

<div>
    Вы действительно хотите удалить категорию <?= $model->category_id ?> - "<?= $model->name?>" <?= $addition ?> ?
</div>

<?= Html::a('Да', ['/admin/categories/deleted/', 'id' => $model->category_id], ['class'=>'btn btn-success']);?>

<?= Html::a('Нет', ['/admin/categories/index'], ['class'=>'btn btn-warning']);?>