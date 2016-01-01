<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_categories_list".
 *
 * @property integer $category_id
 * @property integer $parent_category_id
 * @property string $name
 */
class ProductCategoriesList extends \yii\db\ActiveRecord
{

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
            [['parent_category_id'], 'integer'],
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
            'parent_category_id' => 'Parent Category ID',
            'name' => 'Name',
        ];
    }

    public static function form_tree($mess)
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

}
