<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Category extends \yii\db\ActiveRecord
{
    public $imageFile;

    public static function tableName()
    {
        return 'Category';
    }

    public function rules()
    {
        return [
            [['ProductID', 'ProductName', 'ProductDescription', 'CreatedDate'], 'required'],
            [['CreatedDate', 'ExpiryDate'], 'safe'],
            [['ProductName', 'ProductDescription', 'Image'], 'string', 'max' => 255],
            [['ProductID'], 'integer'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, gif'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ProductID' => 'Product ID',
            'ProductName' => 'Product Name',
            'ProductDescription' => 'Product Description',
            'CreatedDate' => 'Created Date',
            'ExpiryDate' => 'Expiry Date',
            'Image' => 'Image Path',
            'imageFile' => 'Upload Category Image',
        ];
    }

    public function upload()
    {
        if ($this->validate() && $this->imageFile) {
            $uploadPath = 'uploads/categories/';
            $absolutePath = Yii::getAlias('@webroot/' . $uploadPath);

            if (!is_dir($absolutePath)) {
                mkdir($absolutePath, 0777, true);
            }

            $filename = uniqid() . '.' . $this->imageFile->extension;
            $fullPath = $absolutePath . $filename;

            if ($this->imageFile->saveAs($fullPath)) {
                $this->Image = $uploadPath . $filename;
                return true;
            }
        }
        return false;
    }
}
