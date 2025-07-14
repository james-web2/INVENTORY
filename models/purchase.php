<?php
namespace app\models;

use yii\db\ActiveRecord;

class Purchase extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        return 'Purchase';          // ✔ matches table name
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['Reference', 'Supplier', 'Branch', 'date', 'ExpectedDelivery', 'Status', 'Amount'], 'required'],
            [['date', 'ExpectedDelivery', 'CreatedDate'], 'safe'],
            [['Amount'], 'number'],
            [['Reference'], 'string', 'max' => 50],
            [['Supplier', 'Branch'], 'string', 'max' => 100],
            [['Status'], 'string', 'max' => 20],
        ];
    }
}
