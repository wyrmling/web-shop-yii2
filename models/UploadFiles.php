<?php

namespace app\models;

use yii\base\Model;

//use yii\web\UploadedFile;

class UploadFiles extends Model
{

    const OBJECT_TYPE_FOR_PRODUCTS = 1;
    const OBJECT_TYPE_FOR_ARTICLES = 2;
    const OBJECT_TYPE_FOR_NEWS = 3;
    const OBJECT_TYPE_FOR_CATEGORIES = 4;
    const OBJECT_TYPE_FOR_USERS = 5;
    const OBJECT_TYPE_FOR_COMMERCIAL = 6;
    const OBJECT_TYPE_FOR_BRANDS = 7;
    // Scenarios download files of different types
    const SCENARIO_UPLOAD_IMAGES = 'upload_images';

    // an instance of an object 'UploadedFile' from the downloaded file
    public $downloadFile;

    public function rules()
    {
        return [
            [['downloadFile'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_UPLOAD_IMAGES,
                'minWidth' => 100, 'maxWidth' => 2000,
                'minHeight' => 100, 'maxHeight' => 2000,
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $structure = dirname(__DIR__) . '/uploads/487/asd/7/';
            if (!is_dir($structure)) {
                mkdir($structure, 0777, true);
            }
            $this->downloadFile->saveAs($structure . $this->downloadFile->baseName . '.' . $this->downloadFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
