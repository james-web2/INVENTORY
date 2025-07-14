<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Product".
 *
 * @property int $id
 * @property string $ProductDescription
 * @property string $CreatedDate
 * @property string|null $ExpiryDate
 * @property string|null $Image
 * @property UploadedFile $imageFile
 *
 * @property int $currentStock [virtual]
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * Virtual property for file upload
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Product'; // Matches your SQL Server table
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ProductDescription', 'CreatedDate'], 'required'],
            [['CreatedDate', 'ExpiryDate'], 'date', 'format' => 'php:Y-m-d'],
            [['ProductDescription', 'Image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ProductDescription' => 'Product Description',
            'CreatedDate' => 'Created Date',
            'ExpiryDate' => 'Expiry Date',
            'Image' => 'Image',
            'imageFile' => 'Upload Product Image',
        ];
    }

    /**
     * Get display name alias
     * @return string
     */
    public function getName()
    {
        return $this->ProductDescription;
    }

    /**
     * Handles image upload and saves the relative path
     * @return bool
     */
    public function upload()
    {
        if ($this->validate() && $this->imageFile) {
            $uploadPath = 'uploads/products/';
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

    /**
     * Calculates total available stock = StockIn - StockOut
     * @return int
     */
    public function getAvailableStock()
    {
        $stockIn = \app\models\StockIn::find()
            ->where(['product_id' => $this->id])
            ->sum('quantity');

        $stockOut = \app\models\StockOut::find()
            ->where(['product_id' => $this->id])
            ->sum('quantity');

        return (int)$stockIn - (int)$stockOut;
    }

    /**
     * Virtual property for Yii2 GridView support
     * @return int
     */
    public function getCurrentStock()
    {
        return $this->getAvailableStock();
    }
}
