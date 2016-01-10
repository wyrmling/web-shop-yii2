<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['category_id', 'parent_category_id', 'name'], 'required'],
            [['category_id', 'parent_category_id', 'discount'], 'integer'],
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

    public static function getTree()
    {
        $categories = Categories::find()
            ->asArray()
            ->orderBy('name')
            ->all();
        return ArrayHelper::map($categories, 'category_id', 'name', 'parent_category_id');
    }

    public static function getDeleteList($start = 0)
    {
        static $tree, $deleteList;
        if (empty($tree)) {
            $tree = Categories::getTree();
            $deleteList = [(int)$start];
        }
        if (isset($tree[$start])) {
            foreach ($tree[$start] as $cat_id => $name) {
                $deleteList[] = $cat_id;
                self::getDeleteList($cat_id);
            }
        }
        return $deleteList;
    }

}