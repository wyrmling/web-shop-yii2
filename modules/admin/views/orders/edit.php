<?php

//use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use app\models\Orders;
use app\models\OrderDetails;


$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Редактирование заказа №' . $id, 'url' => ["orders/edit/$id"]];

echo "Заказ № $id";
?>

<?php var_dump($order); ?>
<br><br>
<?php var_dump($order_details); ?>

