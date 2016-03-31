<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "articles".
 *
 * @property integer $article_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property text $content
 * @property timestamp $time_created
 * @property integer $created_by
 * @property timestamp $time_apdated
 * @property integer $updated_by
 * @property integer $article_status
 * @property integer $comments_status
 */
class Articles extends ActiveRecord
    {

    const VISIBLE = 1;
    const HIDDEN = 0;
    const YES = 1;
    const NO = 0;

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['article_status', 'comments_status'], 'boolean'],
            ['user_id', 'default', 'value' => \Yii::$app->user->identity->getId()],
            ['created_by', 'default', 'value' => \Yii::$app->user->identity->getId()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'article_id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'content' => 'Текст cтатьи',
            'createdBy.username' => 'Создал',
            'time_created' => 'Cоздана',
            'updatedBy.username' => 'Редактировал',
            'time_updated' => '(дата.время)',
            'article_status' => 'Статья',
            'comments_status' => 'Комментарии',
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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'time_created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'time_updated',
                ],
                'value' => function () {
                    return \Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
                }
            ]
        ];
    }

    public static function articleStatusList()
    {
        return [
            self::HIDDEN => ['Скрыта', 'hidden'],
            self::VISIBLE => ['Опубликована', 'visible'],
        ];
    }

    public static function getArticleStatuses()
    {
        return [self::HIDDEN, self::VISIBLE];
    }

    public static function getArticleStatus($status, $tag = false)
    {
        if ($tag) {
            return self::articleStatusList()[$status][1];
        } else {
            return self::articleStatusList()[$status][0];
        }
    }

    public static function commentsStatusList()
    {
        return [
            self::NO => ['Запрещены', 'disabled'],
            self::YES => ['Разрешены', 'allowed'],
        ];
    }

    public static function getCommentsStatuses()
    {
        return [self::NO, self::YES];
    }

    public static function getCommentsStatus($status, $tag = false)
    {
        if ($tag) {
            return self::commentsStatusList()[$status][1];
        } else {
            return self::commentsStatusList()[$status][0];
        }
    }

    }
