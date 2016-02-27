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
            [['status', 'total_sum'], 'required'],
            [['total_sum'], 'number'],
            [['time_ordered'], 'safe'],
            [['user_phone_number'], 'string',  'length' => [12,15]],
            ['user_phone_number', 'match', 'pattern' => '[\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}]']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'user_phone_number' => 'Номер телефона',
            'status' => 'Status',
            'total_sum' => 'Total Sum',
            'time_ordered' => 'Time Ordered',
        ];
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
            self::UNANSWERED => ['Необработанный', 'unanswered'],
            self::ANSWERED => ['Обработанный', 'answered'],
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
