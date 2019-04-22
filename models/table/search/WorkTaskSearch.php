<?php

namespace app\models\table\search;

use app\models\table\WorkTask;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkTaskSearch represents the model behind the search form of `app\models\table\WorkTask`.
 */
class WorkTaskSearch extends WorkTask
{
    public $task;
    public $exitToObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'exit_to_object_id'], 'integer'],
            [['task', 'exitToObject'], 'safe'],
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
        $query = WorkTask::find();

        $query->joinWith(['task', 'exitToObject']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['task'] = [
            'asc' => ['task.text' => SORT_ASC],
            'desc' => ['task.text' => SORT_DESC],
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
            'task_id' => $this->task_id,
            'exit_to_object_id' => $this->exit_to_object_id,
        ]);

        $query->andFilterWhere(['like', 'task.text', $this->task])
            ->andFilterWhere(['like', 'exit_to_object.brigade_gathering_datetime', $this->exitToObject]);

        return $dataProvider;
    }
}
