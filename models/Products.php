<?php

namespace app\models;

//use Yii;
use yii\db\ActiveRecord;
use app\models\Users;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 * @property integer $brand_id
 * @property integer $name category_id
 * @property string $sku
 * @property string $article
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property double $price
 * @property double $special_price
 * @property integer $created_by
 * @property string $time_created
 * @property integer $updated_by
 * @property string $time_updated
 */
class Products extends \yii\db\ActiveRecord
{

    const VISIBLE = 1;
    const HIDDEN = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'category_id', 'title', 'status'], 'required'],
            [['brand_id', 'category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['price', 'special_price'], 'number'],
            [['time_created', 'time_updated'], 'safe'],
            [['sku', 'article', 'title', 'description'], 'string', 'max' => 255],
            ['created_by', 'default', 'value' => \Yii::$app->user->identity->getId()],
            ['updated_by', 'default', 'value' => \Yii::$app->user->identity->getId()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'ID',
            'brand_id' => 'Бренд',
            'category_id' => 'Категория',
            'category.name' => 'Категория',
            'brand.brand_name' => 'Бренд',
            'sku' => 'SKU',
            'article' => 'Артикул',
            'title' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
            'price' => 'Цена',
            'special_price' => 'Спец.цена',
            'createdBy.username' => 'Добавил',
            'time_created' => '(дата.время)',
            'updatedBy.username' => 'Редактировал',
            'time_updated' => '(дата.время)',
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'updated_by']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brand_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'time_created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'time_updated',
                ],
                'value' => function() {
            return \Yii::$app->formatter->asDate('now', 'php:Y-m-d h:i:s');
        }
            ]
        ];
    }

    public static function productStatusList()
    {
        return [
            self::HIDDEN => ['Скрыт', 'hidden'],
            self::VISIBLE => ['Выставлен', 'visible'],
        ];
    }

    public static function getProductStatuses()
    {
        return [self::HIDDEN, self::VISIBLE];
    }

    public static function getProductStatus($status, $tag = false)
    {
        if ($tag) {
            return self::productStatusList()[$status][1];
        } else {
            return self::productStatusList()[$status][0];
        }
    }

}