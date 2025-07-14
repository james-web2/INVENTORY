<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "stock_in".
 *
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * @property string|null $date
 *
 * @property Product $product
 */
class StockIn extends ActiveRecord
{
    public static function tableName()
    {
        return 'stock_in';
    }

    public function rules()
    {
        return [
            [['product_id', 'quantity'], 'required'],
            [['product_id', 'quantity'], 'integer'],
            [['date'], 'safe'],
            [['product_id'], 'exist', 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
