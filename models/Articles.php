<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;

class Articles extends ActiveRecord
{

    const VISIBLE = 'visible';
    const HIDDEN = 'hidden';
    const YES = 'y';
    const NO = 'n';

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'content'], 'string'],
            ['user_id', 'default', 'value' => \Yii::$app->user->identity->getId()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'article_id' => 'ID статьи',
            'title' => 'Заголовок',
            'user_id' => 'ID автора',
            'description' => 'Описание',
            'user.username' => 'Имя автора',
            'content' => 'Текст cтатьи',
            'created_time' => 'Cоздана',
            'changed_time' => 'Изменена',
            'article_status' => 'Статус статьи',
            'comments_status' => 'Статус комментариев',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    public static function getStatuses()
    {
        return [self::HIDDEN, self::VISIBLE];
    }

    public function getStatusName()
    {
        switch ($this->article_status) {
            case self::HIDDEN:
                return 'Скрыта';
            case self::VISIBLE:
                return 'Опубликована';
        }
    }

    public static function getCommetsStatuses()
    {
        return [self::NO, self::YES];
    }

    public function getCommentsStatusName()
    {
        switch ($this->comments_status) {
            case self::YES:
                return 'Разрешены';
            case self::NO:
                return 'Запрещены';
        }
    }

}
