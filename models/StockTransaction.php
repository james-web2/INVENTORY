<?php

namespace app\models;

use yii\db\ActiveRecord;

class StockTransaction extends ActiveRecord
{
    public static function tableName()
    {
        return 'StockTransaction'; // Match your actual SQL Server table name
    }

    public function rules()
    {
        return [
            [['product_id', 'quantity', 'transaction_type', 'created_at'], 'required'],
            [['product_id', 'quantity'], 'integer'],
            [['transaction_type'], 'string', 'max' => 10], // IN or OUT
            [['created_at'], 'safe'],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
