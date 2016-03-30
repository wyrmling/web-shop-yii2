<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\Products;
use yii\data\ActiveDataProvider;

$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление заказа';
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
            'entered_name' => ['type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Обязательно заполните это поле'],
            //'hint' => 'Обязательно заполните это поле'
            ],
            'user_phone_number' => ['type' => Form::INPUT_TEXT,
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

<?php Pjax::begin(); ?>
<div class="tree">
    <?= buildTree(0, $tree, $quantities); ?>
</div>

<div class = "subblock">
    <?php
    $query = Products::find()->where(['status' => 1]);
    if ($category_id != 0) {
        $query = Products::find()->andWhere(['category_id' => $category_id]);
    }
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => ['pageSize' => 3],
    ]);
    $query->joinWith(['brand' => function ($query) {
            $query->from(['brand' => 'product_brands']);
        }]);
            $dataProvider->sort->attributes['brand.brand_name'] = [
                'asc' => ['brand.brand_name' => SORT_ASC],
                'desc' => ['brand.brand_name' => SORT_DESC],
            ];
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
        </div>
        <?php Pjax::end(); ?>

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
                            . Html::a('pjax', ['orders/add/', 'id' => $cat_id], ['title' => 'список товаров', 'class' => 'btn-category-edit']);
                    $tree .= buildTree($cat_id, $cats, $quant);
                    $tree .= '</li>';
                }
                $tree .= '</ul>';
                return $tree;
            }
        }
        ?>
