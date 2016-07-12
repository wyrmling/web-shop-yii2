<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление заказа';

$this->registerJs("
    function displaylist(categoryid) {
        $.ajax({
            type: 'POST',
            url: '/admin/orders/displaylist',
            data: {id: categoryid},
            success: function(data) {
                $('.subblock').html(data);
            }
        });
    }", \yii\web\View::POS_END);
?>

<div class="admin-edit">

    <?php
    $form = ActiveForm::begin();
    $form->field($model, 'user_phone_number')->hint('')->label()->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '+38 (999) 999-99-99',
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'attributes' => [
            'entered_name' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
//                'hint' => 'Обязательно заполните это поле'
            ],
            'user_phone_number' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
            ],
            'status' => ['type' => Form::INPUT_TEXT],
            'total_sum' => ['type' => Form::INPUT_TEXT],
            'client_comment' => ['type' => Form::INPUT_TEXT],
            'manager_comment' => ['type' => Form::INPUT_TEXT],
        ],
    ]);
    ?>
    <div class="form-group">
        <?= !$model->isNewRecord ? : Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<div class="tree">
    <?= buildTree(0, $tree, $quantities); ?>
</div>

<div class="subblock">
    <?php Pjax::begin(['options' => ['id' => 'pj1']]); ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'product_id',
            'category_id',
            'brand.brand_name',
            'title',
            'price',
            'special_price',
        ],
    ])
    ?>
    <?php Pjax::end(); ?>
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
                    . '</span>'
                    . Html::a('ссылка', ['orders/add/', 'id' => $cat_id], ['title' => 'список товаров', 'class' => 'btn-category-edit'])
                    . '<input type="button" value="L" id="displaylist" onclick="displaylist(' . $cat_id . ')">';
            $tree .= buildTree($cat_id, $cats, $quant);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
        return $tree;
    }
}
?>