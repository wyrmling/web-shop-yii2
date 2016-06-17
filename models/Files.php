<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "files".
 *
 * @property integer $image_id
 * @property integer $object_type_id
 * @property integer $object_id
 * @property string $image_title
 * @property string $mime
 */
class Files extends ActiveRecord
{

    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['object_type_id', 'object_id'], 'required'],
            [['object_type_id', 'object_id'], 'integer'],
            [['image_title', 'mime'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image_id' => 'ID файла',
            'object_type_id' => 'ID типа объекта',
            'object_id' => 'ID объекта',
            'image_title' => 'название файла',
            'mime' => 'тип файла',
        ];
    }

}
