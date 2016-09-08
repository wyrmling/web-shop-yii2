<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
//use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $user_phone_number
 * @property integer $status
 * @property double $total_sum
 * @property string $time_ordered
 * @property string $client_comment
 * @property string $manager_comment
 */
class Orders extends \yii\db\ActiveRecord
{
    
    public $verifyCode;

    const ANSWERED = 1;
    const UNANSWERED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['user_phone_number', 'status', 'total_sum'], 'required', 'message' => 'Пожалуйста, введите номер телефона'],
            [['total_sum'], 'number'],
            [['time_ordered'], 'safe'],
            [['client_comment', 'manager_comment', 'entered_name'], 'string'],
            [['client_comment', 'manager_comment', 'entered_name'], 'trim'],
            [['user_phone_number'], 'string', 'length' => [17, 19]],
            [['entered_name'], 'string', 'length' => [4, 30]],
            ['user_phone_number', 'match', 'pattern' => '[\+38\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}]'],
            [['verifyCode'], 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'ID заказа',
            'user_id' => 'ID  заказчика',
            'user.username' => 'Заказчик',
            'entered_name' => 'Имя',
            'user_phone_number' => 'Номер телефона',
            'status' => 'Статус заказа',
            'total_sum' => 'Сумма заказа',
            'time_ordered' => 'Время заказа',
            'client_comment' => 'Комментарий к заказу',
            'manager_comment' => 'Комментарий менеджера',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'time_ordered',
                ],
                'value' => function () {
            return \Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
        }
            ]
        ];
    }

    public static function orderStatusList()
    {
        return [
            self::UNANSWERED => ['Необработанный', 'hidden'],
            self::ANSWERED => ['Обработанный', 'visible'],
        ];
    }

    public static function getOrderStatuses()
    {
        return [self::UNANSWERED, self::ANSWERED];
    }

    public static function getOrderStatus($status, $tag = false)
    {
        if ($tag) {
            return self::orderStatusList()[$status][1];
        } else {
            return self::orderStatusList()[$status][0];
        }
    }

    public static function countTotalSumm($order_info, $order_details_info)
    {
        $ordered_sum = 0;
        $current_sum = 0;
        $fixed_sum = $order_info->total_sum;
        $ordered_string = '';
        $current_string = '';

        foreach ($order_details_info as $details) {
            if (isset($details->product->special_price)) {
                $current_sum += $details->product->special_price * $details->quantity;
                $current_string .= ' + ' . $details->product->special_price . ' * ' . $details->quantity;
            } else {
                $current_sum += $details->product->price * $details->quantity;
                $current_string .= ' + ' . $details->product->price . ' * ' . $details->quantity;
            }
            $ordered_sum += $details->price * $details->quantity;
            $ordered_string .= ' + ' . $details->price . ' * ' . $details->quantity;
        }
        $ordered_string = substr($ordered_string, 3);
        $current_string = substr($current_string, 3);
        return [
            'ordered_sum' => $ordered_sum,
            'current_sum' => $current_sum,
            'fixed_sum' => $fixed_sum,
            'ordered_string' => $ordered_string,
            'current_string' => $current_string,
        ];
    }

}
