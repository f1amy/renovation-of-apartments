<?php

namespace app\models\table\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\table\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\table\Order`.
 */
class OrderSearch extends Order
{
    public $customer;
    public $workObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer', 'workObject', 'status'], 'safe'],
            [['contract_date', 'period_of_execution'], 'date', 'format' => 'php:Y-m-d'],
            [[
                'id', 'contract_date',
                'period_of_execution', 'customer',
                'workObject', 'status'
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
        $query = Order::find();

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
            'contract_date' => $this->contract_date,
            'period_of_execution' => $this->period_of_execution
        ]);

        $query->andFilterWhere(['like', 'order.id', $this->id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'customer.full_name', $this->customer])
            ->andFilterWhere(['like', 'work_object.house_address', $this->workObject]);

        return $dataProvider;
    }
}
