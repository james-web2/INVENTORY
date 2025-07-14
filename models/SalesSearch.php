<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SaleSearch extends Sales
{
    public function rules()
    {
        return [
            [['SaleDate', 'CustomerName', 'Status'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Sales::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) { return $dataProvider; }

        $query->andFilterWhere(['SaleDate'    => $this->SaleDate])
              ->andFilterWhere(['like', 'CustomerName', $this->CustomerName])
              ->andFilterWhere(['like', 'Status',       $this->Status]);

        return $dataProvider;
    }
}
