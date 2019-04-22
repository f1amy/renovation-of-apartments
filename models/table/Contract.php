<?php

namespace app\models\table;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property int $id
 * @property int $number
 * @property string $date
 *
 * @property Order $order
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'date'], 'required'],
            [['number'], 'integer', 'min' => 0],
            [['date'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['number'], 'unique'],
        ];
    }

    public function init()
    {
        if (!method_exists($this, 'search')) {
            $this->date = date('Y-m-d');
        }

        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'number' => 'Номер',
            'date' => 'Дата заключения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['contract_id' => 'id']);
    }
}
