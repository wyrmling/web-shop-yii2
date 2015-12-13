<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tags_list".
 *
 * @property integer $tag_id
 * @property string $tag_name
 */
class ArticleTagsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_tags_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name'], 'required'],
            [['tag_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag_name' => 'Tag Name',
        ];
    }
}
