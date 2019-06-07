<?php

namespace app\models\table\search;

use app\models\table\Item;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ItemSearch represents the model behind the search form of `app\models\table\Item`.
 */
class ItemSearch extends Item
{
    public $warehouse;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'warehouse_id', 'quantity'], 'integer'],
            [['name', 'type'], 'safe'],
            [['purchase_price'], 'number'],
            [['warehouse'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Item::find();

        $query->joinWith(['warehouse']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['warehouse'] = [
            'asc' => ['warehouse.name' => SORT_ASC],
            'desc' => ['warehouse.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'item.id', $this->id])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'purchase_price', $this->purchase_price])
            ->andFilterWhere(['like', 'item.name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'warehouse.name', $this->warehouse]);

        return $dataProvider;
    }
}
