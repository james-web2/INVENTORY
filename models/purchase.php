<?php
namespace app\models;

use yii\db\ActiveRecord;

class Purchase extends ActiveRecord
{
    public static function tableName()
    {
        return 'Purchase';
    }

    public function rules()
    {
        return [
            [['Reference', 'supplier_id', 'branch_id', 'date', 'ExpectedDelivery', 'Status', 'Amount'], 'required'],
            [['date', 'ExpectedDelivery', 'CreatedDate'], 'safe'],
            [['Amount'], 'number'],
            [['Reference'], 'string', 'max' => 50],
            [['Status'], 'string', 'max' => 20],
            [['customer_id'], 'integer'], // ✅ add customer_id validation
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Reference' => 'Reference',
            'supplier_id' => 'Supplier',
            'branch_id' => 'Branch',
            'date' => 'Purchase Date',
            'ExpectedDelivery' => 'Expected Delivery',
            'Status' => 'Status',
            'Amount' => 'Total Amount',
            'CreatedDate' => 'Created Date',
            'customer_id' => 'Customer', // ✅ new label
        ];
    }

    // ✅ Relations
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(User::class, ['id' => 'customer_id']);
    }
}
