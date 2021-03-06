<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property int $id
 * @property int $item_id
 * @property int $item_quantity
 * @property int $exit_to_object_id
 *
 * @property Item $item
 * @property ExitToObject $exitToObject
 */
class Equipment extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'item_quantity', 'exit_to_object_id'], 'required'],
            [['item_id', 'exit_to_object_id'], 'integer', 'min' => 1],
            ['item_quantity', 'integer', 'min' => 1],
            ['item_quantity', 'validateItemQuantity', 'on' => self::SCENARIO_DEFAULT],
            ['item_quantity', 'validateItemQuantityOnUpdate', 'on' => self::SCENARIO_UPDATE],
            [
                ['item_id', 'exit_to_object_id'],
                'unique',
                'targetAttribute' => ['item_id', 'exit_to_object_id']
            ],
            [
                ['item_id'],
                'exist', 'skipOnError' => true,
                'targetClass' => Item::className(),
                'targetAttribute' => ['item_id' => 'id']
            ],
            [
                ['exit_to_object_id'],
                'exist', 'skipOnError' => true,
                'targetClass' => ExitToObject::className(),
                'targetAttribute' => ['exit_to_object_id' => 'id']
            ],
            [['item_id', 'item_quantity', 'exit_to_object_id'], 'trim'],
        ];
    }

    public function validateItemQuantity($attribute)
    {
        if ($this->item_quantity > $this->item->quantity) {
            $this->addError($attribute, 'Значение «Количество материала» ' .
                'должно быть меньше или равно остатка материала «' .
                $this->item->name . '».');
        }
    }

    public function validateItemQuantityOnUpdate($attribute)
    {
        $oldEquipment = Equipment::findOne(['id' => $this->id]);

        if ($oldEquipment->item_id == $this->item_id) {
            if ($this->item_quantity > ($this->item->quantity + $oldEquipment->item_quantity)) {
                $this->addError($attribute, 'Значение «Количество материала» ' .
                    'должно быть меньше или равно остатка материала «' .
                    $this->item->name . '».');
            }
        } else {
            if ($this->item_quantity > $this->item->quantity) {
                $this->addError($attribute, 'Значение «Количество материала» ' .
                    'должно быть меньше или равно остатка материала «' .
                    $this->item->name . '».');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'item_id' => 'Код материала',
            'item_quantity' => 'Количество материала',
            'exit_to_object_id' => 'Код выхода на объект',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
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
