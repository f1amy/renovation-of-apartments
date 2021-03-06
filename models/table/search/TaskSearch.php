<?php

namespace app\models\table\search;

use app\models\table\Task;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TaskSearch represents the model behind the search form of `app\models\table\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'text', 'unit'], 'safe'],
            [['cost_per_unit'], 'number'],
            [['category', 'text', 'unit', 'cost_per_unit'], 'trim'],
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
        $query = Task::find();

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
        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'cost_per_unit', $this->cost_per_unit]);
            

        return $dataProvider;
    }
}
