<?php

namespace app\models\table\search;

use app\models\table\ExitToObject;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ExitToObjectSearch represents the model behind the search form of `app\models\table\ExitToObject`.
 */
class ExitToObjectSearch extends ExitToObject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id'], 'integer'],
            [['brigade_gathering_datetime'], 'safe'],
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
        $query = ExitToObject::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'brigade_gathering_datetime' => $this->brigade_gathering_datetime
        ]);

        return $dataProvider;
    }
}
