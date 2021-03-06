<?php

namespace app\models\table\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\table\WorkObject;

/**
 * WorkObjectSearch represents the model behind the search form of `app\models\table\WorkObject`.
 */
class WorkObjectSearch extends WorkObject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'id', 'apartment_number', 'apartment_area',
                'number_of_rooms', 'entrance_number', 'floor_number'
            ], 'integer'],
            [['house_address'], 'safe'],
            [[
                'apartment_number', 'apartment_area', 'house_address',
                'number_of_rooms', 'entrance_number', 'floor_number'
            ], 'trim'],
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
        $query = WorkObject::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_ASC];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return
            // any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'apartment_number' => $this->apartment_number,
            'entrance_number' => $this->entrance_number,
            'floor_number' => $this->floor_number,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'house_address', $this->house_address])
            ->andFilterWhere(['like', 'apartment_area', $this->apartment_area])
            ->andFilterWhere(['like', 'number_of_rooms', $this->number_of_rooms]);

        return $dataProvider;
    }
}
