<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StoreSearch extends Store and adds filtering / sorting support for
 * GridView and other data‑provider widgets.
 */
class StoreSearch extends Store
{
    /**
     * Validation rules for search attributes.
     * Mark everything as “safe” so the values can be assigned
     * without triggering “unknown attribute” or mass‑assignment errors.
     */
    public function rules(): array
    {
        return [
            [['StoreName', 'Location', 'ManagerName', 'Phone'], 'safe'],
        ];
    }

    /**
     * Build an ActiveDataProvider with optional filtering
     * based on $params (usually Yii::$app->request->queryParams).
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        // 1️⃣ base query
        $query = Store::find()->orderBy(['CreatedDate' => SORT_DESC]);

        // 2️⃣ data provider (add pagination / sorting if desired)
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => ['pageSize' => 10],
            'sort'       => [
                'defaultOrder' => ['CreatedDate' => SORT_DESC],
                'attributes'   => [
                    'StoreName',
                    'Location',
                    'ManagerName',
                    'Phone',
                    'CreatedDate',
                ],
            ],
        ]);

        // 3️⃣ load form / query‑string values into model
        $this->load($params);

        // 4️⃣ if validation fails – return unfiltered provider
        if (!$this->validate()) {
            return $dataProvider;
        }

        // 5️⃣ apply filters
        $query->andFilterWhere(['like', 'StoreName',   $this->StoreName])
              ->andFilterWhere(['like', 'Location',    $this->Location])
              ->andFilterWhere(['like', 'ManagerName', $this->ManagerName])
              ->andFilterWhere(['like', 'Phone',       $this->Phone]);

        return $dataProvider;
    }
}
