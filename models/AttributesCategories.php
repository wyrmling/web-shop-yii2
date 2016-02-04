<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product_attributes_categories".
 *
 * @property integer $attribute_id
 * @property integer $category_id
 * @property integer $order
 */
class AttributesCategories extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attributes_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'category_id'], 'required'],
            [['attribute_id', 'category_id', 'order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_id' => ' ',
            'category_id' => ' ',
            'order' => 'order',
        ];
    }

    public function getAttributeinfo()
    {
        return $this->hasOne(Attributes::className(), ['attribute_id' => 'attribute_id']);
    }
    
    public function getAttributename()
    {
        return $this->hasOne(Attributes::className(), ['attribute_id' => 'attribute_id']);
    } 
    
}
