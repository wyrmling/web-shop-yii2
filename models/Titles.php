<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titles".
 *
 * @property string $title_id
 * @property string $pattern
 */
class Titles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_id', 'pattern'], 'required'],
            [['title_id', 'pattern'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title_id' => 'Title ID',
            'pattern' => 'Pattern',
        ];
    }
}
