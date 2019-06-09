<?php

namespace app\models\table\search;

use app\models\table\ExitToObject;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ExitToObjectSearch represents the model behind
 * the search form of `app\models\table\ExitToObject`.
 */
class ExitToObjectSearch extends ExitToObject
{
    public $customer;
    public $workObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id'], 'integer'],
            [['customer', 'workObject'], 'safe'],
            [
                ['brigade_gathering_datetime'],
                'datetime', 'format' => 'php:Y-m-d H:i:s'
            ],
            [[
                'order_id', 'customer',
                'brigade_gathering_datetime', 'workObject'
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
        $query = ExitToObject::find();

        $query->joinWith(['customer', 'workObject']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->defaultOrder = ['id' => SORT_ASC];

        $dataProvider->sort->attributes['customer'] = [
            'asc' => ['customer.full_name' => SORT_ASC],
            'desc' => ['customer.full_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['workObject'] = [
            'asc' => ['work_object.house_address' => SORT_ASC],
            'desc' => ['work_object.house_address' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return
            // any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'brigade_gathering_datetime' => $this->brigade_gathering_datetime
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'customer.full_name', $this->customer])
            ->andFilterWhere(['like', 'work_object.house_address', $this->workObject]);

        return $dataProvider;
    }
}
