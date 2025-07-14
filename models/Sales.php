<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Customer;

class Sales extends ActiveRecord
{
    public static function tableName()
    {
        return 'Sales';
    }

    public function rules()
    {
        return [
            [['SaleDate', 'customer_id', 'total', 'Status', 'TotalAmount'], 'required'],
            [['SaleDate', 'createdDate'], 'safe'],
            [['customer_id'], 'integer'],
            [['total', 'TotalAmount'], 'number'],
            [['Status'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SaleDate' => 'Sale Date',
            'customer_id' => 'Customer',
            'total' => 'Total',
            'Status' => 'Status',
            'TotalAmount' => 'Total Amount',
            'createdDate' => 'Created Date',
        ];
    }

    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::class, ['sale_id' => 'id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    public function getCustomerName()
    {
        return $this->customer ? $this->customer->name : 'Unknown'; // adjust field name
    }
}
