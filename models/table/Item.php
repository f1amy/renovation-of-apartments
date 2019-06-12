<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property int $warehouse_id
 * @property string $name
 * @property string $type
 * @property int $quantity
 * @property string $purchase_price
 *
 * @property Equipment[] $equipments
 * @property ExitToObject[] $exitToObjects
 * @property Warehouse $warehouse
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['warehouse_id', 'name', 'type', 'quantity', 'purchase_price'], 'required'],
            [['warehouse_id', 'quantity'], 'integer', 'min' => 1],
            [['type'], 'string'],
            [['type'], 'match', 'pattern' => '/^(Инструмент|Материал|Расходуемое|Другое)$/'],
            [
                ['purchase_price'],
                'number',
                'min' => 0,
                'numberPattern' => '/^\d+((.|,)\d{1,2})?$/'
            ],
            [['name'], 'string', 'max' => 128],
            [['warehouse_id', 'name'], 'unique', 'targetAttribute' => ['warehouse_id', 'name']],
            [
                ['warehouse_id'],
                'exist', 'skipOnError' => true,
                'targetClass' => Warehouse::className(),
                'targetAttribute' => ['warehouse_id' => 'id']
            ],
            [['warehouse_id', 'name', 'type', 'quantity', 'purchase_price'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'warehouse_id' => 'Код склада',
            'name' => 'Наименование',
            'type' => 'Тип',
            'quantity' => 'Количество',
            'purchase_price' => 'Цена покупки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::className(), ['item_id' => 'id']);
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
            'equipment',
            ['item_id' => 'id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouse_id']);
    }
}
