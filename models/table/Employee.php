<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone_number
 * @property string $email_address
 * @property string $position
 *
 * @property RenovatingBrigade[] $renovatingBrigades
 * @property ExitToObject[] $exitToObjects
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'phone_number', 'position'], 'required'],
            [['full_name', 'email_address', 'position'], 'string', 'max' => 64],
            [['email_address'], 'email'],
            [['email_address'], 'default', 'value' => null],
            [
                ['full_name'], 'match', 'pattern' => '/^[А-Я][а-я]+ [А-Я][а-я]+ [А-Я][а-я]+$/u',
                'message' => 'Значение «ФИО» неверно. Используйте формат: "Фамилия Имя Отчество".'
            ],
            [['phone_number'], 'string', 'max' => 32],
            [['phone_number'], 'match', 'pattern' => '/^\+7 \d{3} \d{3}-\d{2}-\d{2}$/'],
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
            'position' => 'Должность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenovatingBrigades()
    {
        return $this->hasMany(RenovatingBrigade::className(), ['employee_id' => 'id']);
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
            'renovating_brigade',
            ['employee_id' => 'id']
        );
    }
}
