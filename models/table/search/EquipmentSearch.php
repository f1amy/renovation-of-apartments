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
    public $workObject;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_quantity'], 'integer'],
            [['item', 'workObject'], 'safe'],
            [['exitToObject'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
        ];
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        $value = $this->exitToObject;

        if ($value != '' && $value != null) {
            if (strtotime($value) != false) {
                $this->exitToObject = \Yii::$app
                    ->formatter->asDatetime($value, 'php:Y-m-d H:i:s');
            }
        }

        return true;
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

        $query->joinWith(['item', 'exitToObject', 'workObject']);

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
            'exit_to_object.brigade_gathering_datetime' => $this->exitToObject
        ]);

        $query->andFilterWhere(['like', 'item_quantity', $this->item_quantity])
            ->andFilterWhere(['like', 'item.name', $this->item])
            ->andFilterWhere([
                'like',
                'work_object.house_address',
                $this->workObject
            ]);

        return $dataProvider;
    }
}
