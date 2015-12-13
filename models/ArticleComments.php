<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_comments".
 *
 * @property integer $comment_id
 * @property integer $article_id
 * @property integer $user_id
 * @property string $text
 * @property string $created_time
 *
 * @property Articles $article
 */
class ArticleComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'user_id', 'text'], 'required'],
            [['article_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['created_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'article_id' => 'Article ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['article_id' => 'article_id']);
    }
}
