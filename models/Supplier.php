<?php

namespace app\models;

use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    public static function tableName()
    {
        return 'Supplier'; // ✅ Make sure this matches your database table name
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'contact', 'email'], 'string', 'max' => 100],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Supplier Name',
            'contact' => 'Contact',
            'email' => 'Email',
        ];
    }

    // Optional: reverse relation from Supplier to Purchase
    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['supplier_id' => 'id']);
    }
}
