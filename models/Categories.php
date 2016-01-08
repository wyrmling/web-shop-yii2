<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_categories_list".
 *
 * @property integer $category_id
 * @property integer $parent_category_id
 * @property string $name
 * @property intreger $discount
 */
class Categories extends \yii\db\ActiveRecord
{

    public static $array = array();

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_categories_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_category_id', 'name'], 'required'],
            [['parent_category_id', 'discount'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'parent_category_id' => '',
            'name' => '',
        ];
    }

    public static function formTree($mess)
    {
        if (!is_array($mess)) {
            return false;
        }
        $tree = array();
        foreach ($mess as $value) {
            $tree[$value['parent_category_id']][] = $value;
        }
        return $tree;
    }

    public static function buildArray($cats, $parent_id)
    {
        if (isset($cats[$parent_id])) {
            foreach ($cats[$parent_id] as $cat) {
                self::$array[] = $cat['category_id'];
                self::buildArray($cats, $cat['category_id']);
            }
        }
        return self::$array;
    }

}
