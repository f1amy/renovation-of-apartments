<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $text
 * @property string $cost
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
            [['text', 'cost'], 'required'],
            [['cost'], 'number', 'numberPattern' => '/^\d+((.|,)\d{1,2})?$/'],
            [['text'], 'string', 'max' => 64],
            [['text'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'text' => 'Текст',
            'cost' => 'Стоимость услуги',
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
        return $this->hasMany(ExitToObject::className(), ['id' => 'exit_to_object_id'])->viaTable('work_task', ['task_id' => 'id']);
    }
}
