<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for "employee" report form.
 *
 * @property string $start_date
 * @property string $end_date
 */
class EmployeeReport extends Model
{
    public $start_date;
    public $end_date;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'required'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:Y-m-d'],
            ['end_date', 'compare', 'compareAttribute' => 'start_date', 'operator' => '>='],
        ];
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        $start_date = $this->start_date;
        $end_date = $this->end_date;

        if (
            $start_date != '' && $start_date !== null
            && $end_date != '' && $end_date !== null
        ) {
            if (
                strtotime($start_date) != false
                && strtotime($end_date) != false
            ) {
                $this->start_date = Yii::$app
                    ->formatter->asDate($start_date, 'php:Y-m-d');
                $this->end_date = Yii::$app
                    ->formatter->asDate($end_date, 'php:Y-m-d');
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
            'start_date' => 'Начальная дата',
            'end_date' => 'Конечная дата'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if (!method_exists($this, 'search')) {
            $this->start_date = '01.' . date('m.Y');
            $this->end_date = date('d.m.Y');
        }

        parent::init();
    }
}
