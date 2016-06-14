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

    const OBJECT_TYPE_FOR_PRODUCTS = 1;
    const OBJECT_TYPE_FOR_ARTICLES = 2;
    const OBJECT_TYPE_FOR_NEWS = 3;
    const OBJECT_TYPE_FOR_CATEGORIES = 4;
    const OBJECT_TYPE_FOR_USERS = 5;
    const OBJECT_TYPE_FOR_COMMERCIAL = 6;
    const OBJECT_TYPE_FOR_BRANDS = 7;

    public $imageFile;

    public static function tableName()
    {
        return 'images';
    }

    public function rules()
    {
        return [
    //        [['object_type_id', 'object_id'], 'required'],
    //        [['object_type_id', 'object_id'], 'integer'],
    //       [['image_title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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

    public function upload()
    {
        if ($this->validate()) {
            $structure = dirname(__DIR__) . '/uploads/487/asd/7/';
            if (!is_dir($structure)){
            mkdir($structure, 0777, true);
            }
            $this->imageFile->saveAs($structure . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
