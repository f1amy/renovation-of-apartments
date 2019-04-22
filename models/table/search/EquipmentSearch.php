<?php

namespace app\models\table\search;

use app\models\table\Equipment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EquipmentSearch represents the model behind the search form of `app\models\table\Equipment`.
 */
class EquipmentSearch extends Equipment
{
    public $item;
    public $exitToObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'exit_to_object_id', 'item_quantity'], 'integer'],
            [['item', 'exitToObject'], 'safe'],
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
        $query = Equipment::find();

        $query->joinWith(['item', 'exitToObject']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['item'] = [
            'asc' => ['item.name' => SORT_ASC],
            'desc' => ['item.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['exitToObject'] = [
            'asc' => ['exit_to_object.brigade_gathering_datetime' => SORT_ASC],
            'desc' => ['exit_to_object.brigade_gathering_datetime' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'item_id' => $this->item_id,
            'exit_to_object_id' => $this->exit_to_object_id,
            'item_quantity' => $this->item_quantity,
        ]);

        $query->andFilterWhere(['like', 'item.name', $this->item])
            ->andFilterWhere(['like', 'exit_to_object.brigade_gathering_datetime', $this->exitToObject]);

        return $dataProvider;
    }
}
