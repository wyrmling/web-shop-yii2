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
 * @property integer $discount
 * @property integer $quantity_visible
 * @property integer $quantity_invisible
 */
class Categories extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'product_categories_list';
    }

    public function rules()
    {
        return [
            [['parent_category_id', 'name'], 'required',],
            [['parent_category_id', 'discount', 'quantity_visible', 'quantity_invisible'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'trim']
        ];
    }

    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'parent_category_id' => '',
            'name' => '',
            'quantity_visible' => 'Количество видимых товаров',
            'quantity_invisible' => 'Количество невидимых товаров',
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

    public static function getFullPath($id, $fullPath = [])
    {
        static $categoryList;
        if ($id == 0) {
            return;
        } else {
            if (empty($categoryList)) {
                $categoryList = Categories::getCategoriesList();
            }
            $fullPath[] = $categoryList[$id]['category_id'];
            if (($categoryList[$id]['parent_category_id']) > 0) {
                return self::getFullPath(($categoryList[$id]['parent_category_id']), $fullPath);
            }
            return $fullPath;
        }
    }

    public static function getCategoriesList()
    {
        return Categories::find()
            ->indexBy('category_id')
            ->asArray()
            ->all();
    }

    public static function getDeleteList($start = 0)
    {
        static $tree, $deleteList;

        if (empty($tree)) {
            $tree = Categories::getTree();
            $deleteList = [(int) $start];
        }
        if (isset($tree[$start])) {
            foreach ($tree[$start] as $cat_id => $name) {
                $deleteList[] = $cat_id;
                self::getDeleteList($cat_id);
            }
        }
        return $deleteList;
    }

    public static function setCategoriesCounters($categoryId, $counterVisible, $counterInvisible)
    {
        return self::updateAllCounters(
            [
                'quantity_visible' => $counterVisible,
                'quantity_invisible' => $counterInvisible,
            ],
            [
                'category_id' => self::getFullPath($categoryId)
            ]
        );
    }

    public function transactions()
    {
        return [
            'admin' => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
            'api' => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
        ];
    }

}