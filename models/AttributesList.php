<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_attributes_list".
 *
 * @property integer $attribute_id
 * @property integer $product_id
 * @property string $value
 */
class AttributesList extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attributes_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'product_id'], 'required'],
            [['attribute_id', 'product_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['value'], 'trim']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_id' => 'Attribute ID',
            'product_id' => 'Product ID',
            'value' => 'Value',
        ];
    }
    
}
