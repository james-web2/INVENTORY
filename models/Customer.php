<?php

namespace app\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord
{
    public static function tableName()
    {
        return 'Customer'; // ✅ Match your actual table name
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            // Add any other fields here
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Customer Name',
        ];
    }

    // Optional: if sales are related
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['customer_id' => 'id']);
    }
}
