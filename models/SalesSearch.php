<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SalesSearch extends Sales
{
    public $CustomerName; // virtual attribute for filtering

    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['SaleDate', 'Status', 'createdDate', 'CustomerName'], 'safe'],
            [['TotalAmount'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios(); // skip parent implementation
    }

    public function search($params)
    {
        $query = Sales::find();
        $query->joinWith(['customer']); // joins the related customer

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        // Enable sorting for virtual column
        $dataProvider->sort->attributes['CustomerName'] = [
            'asc' => ['Customer.name' => SORT_ASC],
            'desc' => ['Customer.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Apply filters
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'SaleDate' => $this->SaleDate,
            'TotalAmount' => $this->TotalAmount,
            'createdDate' => $this->createdDate,
        ]);

        $query->andFilterWhere(['like', 'Status', $this->Status])
              ->andFilterWhere(['like', 'Customer.name', $this->CustomerName]);

        return $dataProvider;
    }
}
