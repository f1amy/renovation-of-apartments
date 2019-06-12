<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "renovating_brigade".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $exit_to_object_id
 *
 * @property Employee $employee
 * @property ExitToObject $exitToObject
 */
class RenovatingBrigade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'renovating_brigade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'exit_to_object_id'], 'required'],
            [['employee_id', 'exit_to_object_id'], 'integer', 'min' => 1],
            [
                ['employee_id', 'exit_to_object_id'], 'unique',
                'targetAttribute' => [
                    'employee_id',
                    'exit_to_object_id'
                ]
            ],
            [
                ['employee_id'], 'exist',
                'skipOnError' => true, 'targetClass' => Employee::className(),
                'targetAttribute' => ['employee_id' => 'id']
            ],
            [
                ['exit_to_object_id'], 'exist',
                'skipOnError' => true, 'targetClass' => ExitToObject::className(),
                'targetAttribute' => ['exit_to_object_id' => 'id']
            ],
            [['employee_id', 'exit_to_object_id'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'employee_id' => 'Код сотрудника',
            'exit_to_object_id' => 'Код выхода на объект',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExitToObject()
    {
        return $this->hasOne(ExitToObject::className(), ['id' => 'exit_to_object_id']);
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
