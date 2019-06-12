<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "work_object".
 *
 * @property int $id
 * @property string $house_address
 * @property int $apartment_number
 * @property int $apartment_area
 * @property int $number_of_rooms
 * @property int $entrance_number
 * @property int $floor_number
 *
 * @property Order[] $orders
 */
class WorkObject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'house_address', 'apartment_number',
                'apartment_area', 'number_of_rooms'
            ], 'required'],
            [['entrance_number', 'floor_number'], 'default', 'value' => null],
            [
                [
                    'apartment_number', 'apartment_area',
                    'number_of_rooms', 'entrance_number', 'floor_number'
                ],
                'integer', 'min' => 1
            ],
            [['house_address'], 'string', 'max' => 64],
            [
                ['house_address', 'apartment_number'],
                'unique', 'targetAttribute' => [
                    'house_address',
                    'apartment_number'
                ]
            ],
            [[
                'house_address', 'apartment_number',
                'apartment_area', 'number_of_rooms',
                'entrance_number', 'floor_number'
            ], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'house_address' => 'Адрес дома',
            'apartment_number' => 'Номер квартиры',
            'apartment_area' => 'Площадь квартиры, м2',
            'number_of_rooms' => 'Количество комнат',
            'entrance_number' => 'Номер подъезда',
            'floor_number' => 'Номер этажа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['work_object_id' => 'id']);
    }
}
