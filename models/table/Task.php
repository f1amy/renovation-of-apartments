<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $category
 * @property string $text
 * @property string $unit
 * @property string $cost_per_unit
 *
 * @property WorkTask[] $workTasks
 * @property ExitToObject[] $exitToObjects
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'text', 'unit', 'cost_per_unit'], 'required'],
            [['category', 'unit'], 'string'],
            [['cost_per_unit'], 'number', 'min' => 0, 'numberPattern' => '/^\d+((.|,)\d{1,2})?$/'],
            [
                ['category'], 'match',
                'pattern' => '/^(Потолок|Стены|Пол|Коммуникации|Демонтаж|Остальное)$/'
            ],
            [
                ['unit'], 'match',
                'pattern' => '/^(Квадратный метр|Штука|Погонный метр|Комплект|Не применимо)$/'
            ],
            [['text'], 'string', 'max' => 128],
            [['category', 'text'], 'unique', 'targetAttribute' => ['category', 'text']],
            [['category', 'text', 'unit', 'cost_per_unit'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'category' => 'Категория',
            'text' => 'Текст',
            'unit' => 'Единица измерения',
            'cost_per_unit' => 'Стоимость за единицу',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTasks()
    {
        return $this->hasMany(WorkTask::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExitToObjects()
    {
        return $this->hasMany(
            ExitToObject::className(),
            ['id' => 'exit_to_object_id']
        )->viaTable(
            'work_task',
            ['task_id' => 'id']
        );
    }
}
