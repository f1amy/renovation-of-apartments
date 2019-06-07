<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "exit_to_object".
 *
 * @property int $id
 * @property int $order_id
 * @property string $brigade_gathering_datetime
 *
 * @property Equipment[] $equipments
 * @property Item[] $items
 * @property Order $order
 * @property RenovatingBrigade[] $renovatingBrigades
 * @property Employee[] $employees
 * @property WorkTask[] $workTasks
 * @property Task[] $tasks
 */
class ExitToObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exit_to_object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'brigade_gathering_datetime'], 'required'],
            [['order_id'], 'integer', 'min' => 0],
            [['brigade_gathering_datetime'], 'safe'],
            [
                ['order_id', 'brigade_gathering_datetime'],
                'unique',
                'targetAttribute' => ['order_id', 'brigade_gathering_datetime']
            ],
            [
                ['brigade_gathering_datetime'],
                'datetime', 'format' => 'php:Y-m-d H:i:s'
            ],
            [
                ['order_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Order::className(),
                'targetAttribute' => ['order_id' => 'id']
            ],
        ];
    }

    public function init()
    {
        if (!method_exists($this, 'search')) {
            $this->brigade_gathering_datetime = date('d.m.Y H:i');
        }

        parent::init();
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        $value = $this->brigade_gathering_datetime;

        if ($value != '' && $value != null) {
            if (strtotime($value) != false) {
                $this->brigade_gathering_datetime = Yii::$app
                    ->formatter->asDatetime($value, 'php:Y-m-d H:i:s');
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'order_id' => 'Код заказа',
            'brigade_gathering_datetime' => 'Дата и время встречи рабочих бригады',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['exit_to_object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(
            Item::className(),
            ['id' => 'item_id']
        )->viaTable(
            'equipment',
            ['exit_to_object_id' => 'id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(
            Customer::className(),
            ['id' => 'customer_id']
        )->via('order');
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
    public function getRenovatingBrigades()
    {
        return $this->hasMany(RenovatingBrigade::className(), ['exit_to_object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(
            Employee::className(),
            ['id' => 'employee_id']
        )->viaTable(
            'renovating_brigade',
            ['exit_to_object_id' => 'id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTasks()
    {
        return $this->hasMany(WorkTask::className(), ['exit_to_object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(
            Task::className(),
            ['id' => 'task_id']
        )->viaTable(
            'work_task',
            ['exit_to_object_id' => 'id']
        );
    }
}
