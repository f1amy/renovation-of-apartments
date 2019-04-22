<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property int $id
 * @property int $item_id
 * @property int $exit_to_object_id
 * @property int $item_quantity
 *
 * @property Item $item
 * @property ExitToObject $exitToObject
 */
class Equipment extends \yii\db\ActiveRecord
{
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
            [['item_id', 'exit_to_object_id', 'item_quantity'], 'required'],
            [['item_id', 'exit_to_object_id', 'item_quantity'], 'integer', 'min' => 0],
            [['item_id', 'exit_to_object_id'], 'unique', 'targetAttribute' => ['item_id', 'exit_to_object_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'item_id' => 'Код вещи',
            'exit_to_object_id' => 'Код выхода на объект',
            'item_quantity' => 'Количество вещей',
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
}
