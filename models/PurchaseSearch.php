<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PurchaseSearch extends Purchase
{
    public $Supplier; // virtual field for filtering by supplier name
    public $Branch;   // virtual field if Branch is a relation too

    public function rules()
    {
        return [
            [['Reference', 'Status', 'Supplier', 'Branch'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios(); // skip default scenarios
    }

    public function search($params)
    {
        $query = Purchase::find();

        // Join with related supplier table if relation exists
        $query->joinWith(['supplier']); // Ensure getSupplier() is in Purchase model

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Enable sorting by Supplier name
        $dataProvider->sort->attributes['Supplier'] = [
            'asc' => ['Supplier.name' => SORT_ASC],
            'desc' => ['Supplier.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Reference', $this->Reference])
              ->andFilterWhere(['like', 'Status', $this->Status])
              ->andFilterWhere(['like', 'Supplier.name', $this->Supplier]);

        return $dataProvider;
    }
}
