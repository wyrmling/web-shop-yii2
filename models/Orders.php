<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $user_phone_number
 * @property integer $status
 * @property double $total_sum
 * @property string $time_ordered
 */
class Orders extends \yii\db\ActiveRecord
    {

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
            [['user_phone_number', 'status', 'total_sum'], 'required'],
            [['total_sum'], 'number'],
            [['time_ordered'], 'safe'],
            [['user_phone_number'], 'string',  'length' => [17,19]],
            ['user_phone_number', 'match', 'pattern' => '[\+38\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}]']
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
            'user_phone_number' => 'Номер телефона',
            'status' => 'Статус заказа',
            'total_sum' => 'Сумма заказа',
            'time_ordered' => 'Время заказа',
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

    }
