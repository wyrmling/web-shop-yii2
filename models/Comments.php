<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_comments".
 *
 * @property integer $comment_id
 * @property integer $comment_type
 * @property integer $object_id
 * @property integer $user_id
 * @property string $text
 * @property string $created_time
 *
 * @property Articles $article
 */

class Comments extends \yii\db\ActiveRecord
{

    const TYPE_ARTICLE = 1;
    const TYPE_NEWS = 2;

    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['comment_type', 'object_id', 'user_id', 'text'], 'required'],
            [['comment_type', 'object_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['created_time'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'comment_type' => 'Comment type',
            'object_id' => 'Article ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'created_time' => 'Created time',
        ];
    }

    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['object_id' => 'article_id', 'comment_type' => self::TYPE_ARTICLE]);
    }

    public function getNews()
    {
        return $this->hasOne(News::className(), ['object_id' => 'news_id', 'comment_type' => self::TYPE_NEWS]);
    }

}
