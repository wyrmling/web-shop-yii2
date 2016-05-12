<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_brands".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $logo_url
 * @property integer $discount
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name'], 'required', 'message' => 'Пожалуйста, введите имя бренда'],
            [['discount'], 'integer'],
            [['brand_name', 'logo_url'], 'string', 'max' => 255],
            [['brand_name', 'logo_url'], 'trim'] 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'ID бренда',
            'brand_name' => 'Название бренда',
            'logo_url' => 'Logo Url',
            'discount' => 'Скидка на бренд (%)',
        ];
    }
}
