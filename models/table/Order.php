<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $contract_date
 * @property int $customer_id
 * @property int $work_object_id
 *
 * @property ExitToObject[] $exitToObjects
 * @property Customer $customer
 * @property WorkObject $workObject
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contract_date', 'customer_id', 'work_object_id'], 'required'],
            [['contract_date'], 'date', 'format' => 'php:Y-m-d'],
            [['customer_id', 'work_object_id'], 'integer', 'min' => 0],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['work_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkObject::className(), 'targetAttribute' => ['work_object_id' => 'id']],
        ];
    }

    public function init()
    {
        if (!method_exists($this, 'search')) {
            $this->contract_date = date('Y-m-d');
        }

        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер договора',
            'contract_date' => 'Дата заключения договора',
            'customer_id' => 'Код заказчика',
            'work_object_id' => 'Код рабочего объекта',
            'totalCost' => 'Общая сумма',
        ];
    }

    public function getTotalCost()
    {
        $totalCost = 0;

        foreach ($this->exitToObjects as $exitToObject) {
            foreach ($exitToObject->tasks as $task) {
                $totalCost += $task->cost;
            }

            foreach ($exitToObject->equipments as $equipment) {
                $item = $equipment->item;

                if ($item->type == 'Материал') {
                    $totalCost += $item->purchase_price * $equipment->item_quantity;
                }
            }
        }

        return $totalCost;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExitToObjects()
    {
        return $this->hasMany(ExitToObject::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkObject()
    {
        return $this->hasOne(WorkObject::className(), ['id' => 'work_object_id']);
    }
}
