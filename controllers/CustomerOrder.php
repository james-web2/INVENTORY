<?php
namespace app\models;

use yii\db\ActiveRecord;

class CustomerOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 'CustomerOrder'; // match DB table name
    }

    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'quantity'], 'required'],
            [['customer_id', 'product_id', 'quantity'], 'integer'],
            [['total_price'], 'number'],
            [['created_at'], 'safe'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
