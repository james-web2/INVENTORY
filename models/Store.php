<?php
namespace app\models;

use yii\db\ActiveRecord;

class Store extends ActiveRecord
{
    public static function tableName()
    {
        return 'Store'; // Database table name
    }

    public function rules()
    {
        return [
            [['StoreName'], 'required'], // Required field
            [['StoreName', 'Location', 'ManagerName'], 'string', 'max' => 100], // Text fields with max length
            [['Phone'], 'string', 'max' => 20], // Phone number
            [['CreatedDate'], 'safe'], // Allow date to be assigned without validation
        ];
    }
}
