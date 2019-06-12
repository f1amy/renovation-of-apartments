<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $contract_date
 * @property string $period_of_execution
 * @property int $customer_id
 * @property int $work_object_id
 * @property string $status
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
            [['contract_date', 'period_of_execution', 'customer_id', 'work_object_id', 'status'], 'required'],
            [['contract_date', 'period_of_execution'], 'date', 'format' => 'php:Y-m-d'],
            [['customer_id', 'work_object_id'], 'integer', 'min' => 1],
            [['status'], 'string'],
            [['status'], 'match', 'pattern' => '/^(В работе|Завершено|Отменено)$/'],
            [
                ['customer_id'], 'exist',
                'skipOnError' => true, 'targetClass' => Customer::className(),
                'targetAttribute' => ['customer_id' => 'id']
            ],
            [
                ['work_object_id'], 'exist',
                'skipOnError' => true, 'targetClass' => WorkObject::className(),
                'targetAttribute' => ['work_object_id' => 'id']
            ],
            ['period_of_execution', 'compare', 'compareAttribute' => 'contract_date', 'operator' => '>='],
            [['contract_date', 'period_of_execution', 'customer_id', 'work_object_id', 'status'], 'trim'],
        ];
    }

    public function init()
    {
        if (!method_exists($this, 'search')) {
            $this->contract_date = date('d.m.Y');
            $this->status = 'В работе';
        }

        parent::init();
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        $contract_date = $this->contract_date;

        if ($contract_date != '' && $contract_date !== null) {
            if (strtotime($contract_date) != false) {
                $this->contract_date = Yii::$app
                    ->formatter->asDate($contract_date, 'php:Y-m-d');
            }
        }

        $period_of_execution = $this->period_of_execution;

        if ($period_of_execution != '' && $period_of_execution !== null) {
            if (strtotime($period_of_execution) != false) {
                $this->period_of_execution = Yii::$app
                    ->formatter->asDate($period_of_execution, 'php:Y-m-d');
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
            'id' => 'Номер договора',
            'contract_date' => 'Дата заключения договора',
            'period_of_execution' => 'Срок выполнения',
            'customer_id' => 'Код заказчика',
            'work_object_id' => 'Код рабочего объекта',
            'status' => 'Статус',
            'partialCost' => 'Частичная сумма',
        ];
    }

    public function getPartialCost()
    {
        $partialCost = 0;

        foreach ($this->exitToObjects as $exitToObject) {
            foreach ($exitToObject->tasks as $task) {
                if ($task->category == 'Штука' || $task->category == 'Комплект') {
                    $partialCost += $task->cost_per_unit;
                }
            }

            foreach ($exitToObject->equipments as $equipment) {
                $item = $equipment->item;

                if ($item->type == 'Материал' || $item->type == 'Расходуемое') {
                    $partialCost += $item->purchase_price * $equipment->item_quantity;
                }
            }
        }

        return $partialCost;
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
