<?php ?>

<?= $form->field($order, 'user_id')->hiddenInput(['value' => \Yii::$app->user->id])->label(false) ?>
<?= $form->field($order, 'entered_name')->hiddenInput(['value' => $client_info['first_name'].' '.$client_info['last_name']])->label(false) ?>
<?= $form->field($order, 'user_phone_number')->hiddenInput(['value' => $client_info['phone_number']])->label(false) ?>