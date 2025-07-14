<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SaleItem".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property float $total
 *
 * @property Product $product
 * @property Sales $sales
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SaleItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'quantity', 'price'], 'required'],
            [['sale_id', 'product_id', 'quantity'], 'integer'],
            [['price', 'total'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'product_id' => 'Product',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
        ];
    }

    /**
     * Gets the related Product model
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets the related Sales model
     */
    public function getSales()
    {
        return $this->hasOne(Sales::class, ['id' => 'sale_id']);
    }

    /**
     * Automatically calculate total before saving
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->total = $this->quantity * $this->price;
            return true;
        }
        return false;
    }
}
