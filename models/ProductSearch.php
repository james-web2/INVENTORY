<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PurchaseSearch extends Purchase
{
    /** @inheritdoc */
    public function rules()
    {
        return [
            [['Reference', 'Supplier', 'Branch', 'Status'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Purchase::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Reference', $this->Reference])
              ->andFilterWhere(['like', 'Supplier',  $this->Supplier])
              ->andFilterWhere(['like', 'Branch',    $this->Branch])
              ->andFilterWhere(['like', 'Status',    $this->Status]);

        return $dataProvider;
    }
}
