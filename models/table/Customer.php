<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email_address
 *
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone_number'], 'required'],
            [['full_name', 'email_address'], 'string', 'max' => 64],
            [
                ['full_name'], 'match', 'pattern' => '/^[А-Я][а-я]+ [А-Я][а-я]+ [А-Я][а-я]+$/u',
                'message' => 'Значение «ФИО» неверно. Используйте формат: "Фамилия Имя Отчество".'
            ],
            [['phone_number'], 'string', 'max' => 32],
            [
                ['phone_number'], 'match',
                'pattern' => '/^\+7 \d{3} \d{3}-\d{2}-\d{2}$/'
            ],
            [['email_address'], 'email'],
            [['email_address'], 'default', 'value' => null],
            [['phone_number'], 'unique'],
            [['email_address'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'full_name' => 'ФИО',
            'phone_number' => 'Номер телефона',
            'email_address' => 'Электронный адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
