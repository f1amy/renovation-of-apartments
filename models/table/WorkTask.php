<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "work_task".
 *
 * @property int $id
 * @property int $task_id
 * @property int $exit_to_object_id
 *
 * @property Task $task
 * @property ExitToObject $exitToObject
 */
class WorkTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'exit_to_object_id'], 'required'],
            [['task_id', 'exit_to_object_id'], 'integer', 'min' => 0],
            [['task_id', 'exit_to_object_id'], 'unique', 'targetAttribute' => ['task_id', 'exit_to_object_id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['exit_to_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExitToObject::className(), 'targetAttribute' => ['exit_to_object_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'task_id' => 'Код задачи',
            'exit_to_object_id' => 'Код выхода на объект',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExitToObject()
    {
        return $this->hasOne(
            ExitToObject::className(),
            ['id' => 'exit_to_object_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkObject()
    {
        return $this->hasOne(
            WorkObject::className(),
            ['id' => 'work_object_id']
        )->via('order');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(
            Order::className(),
            ['id' => 'order_id']
        )->via('exitToObject');
    }
}
