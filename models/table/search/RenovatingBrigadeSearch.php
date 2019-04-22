<?php

namespace app\models\table\search;

use app\models\table\RenovatingBrigade;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RenovatingBrigadeSearch represents the model behind the search form of `app\models\table\RenovatingBrigade`.
 */
class RenovatingBrigadeSearch extends RenovatingBrigade
{
    public $employee;
    public $exitToObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'exit_to_object_id'], 'integer'],
            [['employee', 'exitToObject'], 'safe'],
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
        $query = RenovatingBrigade::find();

        $query->joinWith(['employee', 'exitToObject']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['employee'] = [
            'asc' => ['employee.full_name' => SORT_ASC],
            'desc' => ['employee.full_name' => SORT_DESC],
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
            'employee_id' => $this->employee_id,
            'exit_to_object_id' => $this->exit_to_object_id,
        ]);

        $query->andFilterWhere(['like', 'employee.full_name', $this->employee])
            ->andFilterWhere(['like', 'exit_to_object.brigade_gathering_datetime', $this->exitToObject]);

        return $dataProvider;
    }
}
