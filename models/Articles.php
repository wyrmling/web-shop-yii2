<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Users;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

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
    const SCENARIO_FILTER = 'filter';

    public static function tableName()
    {
        return 'articles';
    }

    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'Пожалуйста, введите название статьи', 'except' => self::SCENARIO_FILTER],
            [['title', 'description', 'content'], 'string'],
            [['title', 'description', 'content'], 'trim'],
            [['article_status', 'comments_status'], 'boolean'],
            ['created_by', 'default', 'value' => \Yii::$app->user->id],
            [['time_created', 'time_updated'], 'date', 'on' => self::SCENARIO_FILTER,],
//          ['created_by', 'integer'],
            ['article_id', 'integer'],
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

    public function search($params)
    {
        $query = Articles::find()
            ->joinWith(['createdBy' => function($query) {
                $query->from(['createdBy' => 'users']);
            }]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
            $dataProvider->sort->attributes['createdBy.username'] = [
                'asc' => ['createdBy.username' => SORT_ASC],
                'desc' => ['createdBy.username' => SORT_DESC],
            ];
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
            $query->andFilterWhere(['like', 'article_id', $this->article_id]);
            $query->andFilterWhere(['like', 'title', $this->title]);
            $query->andFilterWhere(['like', 'description', $this->description]);
            $query->andFilterWhere(['like', 'time_created', $this->time_created]);
            $query->andFilterWhere(['like', 'article_status', $this->article_status]);
            $query->andFilterWhere(['like', 'comments_status', $this->comments_status]);

//        $query->andFilterCompare('value', '<=100');
            return $dataProvider;
        }

        public function getUser()
        {
            return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
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

        public static function articleFilterList()
        {
            return [
                self::HIDDEN => 'Скрыта',
                self::VISIBLE => 'Опубликована',
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

        public static function commentsFilterList()
        {
            return [
                self::NO => 'Запрещены',
                self::YES => 'Разрешены',
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
