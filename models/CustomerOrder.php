<?php

namespace app\models;

use yii\db\ActiveRecord;

class CustomerOrder extends ActiveRecord
{
    public static function tableName()
    {
        return 'CustomerOrder';
    }

    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'quantity'], 'required'],
            [['customer_id', 'product_id', 'quantity'], 'integer'],
            [['quantity'], 'integer', 'min' => 1],
            [['total_price'], 'number'],
            [['status'], 'string', 'max' => 50],
            [['created_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer',
            'product_id' => 'Product',
            'quantity' => 'Quantity',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'created_at' => 'Order Date',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(User::class, ['id' => 'customer_id']);
    }
}
