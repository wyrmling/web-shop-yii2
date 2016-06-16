<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "images".
 *
 * @property integer $image_id
 * @property integer $object_type_id
 * @property integer $object_id
 * @property string $image_title
 */
class Images extends ActiveRecord
{

    public static function tableName()
    {
        return 'images';
    }

    public function rules()
    {
        return [
            [['object_type_id', 'object_id'], 'required'],
            [['object_type_id', 'object_id'], 'integer'],
            [['image_title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image_id' => 'ID картинки',
            'object_type_id' => 'ID типа объекта',
            'object_id' => 'ID объекта',
            'image_title' => 'название картинки',
        ];
    }

}
