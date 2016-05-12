<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_attributes".
 *
 * @property integer $attribute_id
 * @property string $attribute_name
 * @property string $unit
 */
class Attributes extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_name'], 'required', 'message' => 'Пожалуйста, введите имя атрибута'],
            [['attribute_name', 'unit'], 'string', 'max' => 255],
            [['attribute_name', 'unit'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_id' => 'ID',
            'attribute_name' => 'Название атрибута',
            'unit' => 'Единица измерения',
        ];
    }
}
