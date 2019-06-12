<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;

use app\models\table\Order;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exit-to-object-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'order_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Order::find()->where(
            ['status' => 'В работе']
        )->all(), 'id', function ($model) {
            $contract_date = \Yii::$app->formatter
                ->asDate($model->contract_date, 'php:d.m.Y');
            $period_of_execution = \Yii::$app->formatter
                ->asDate($model->period_of_execution, 'php:d.m.Y');

            return 'Договор №' . $model->id . ' от ' . $contract_date .
                ' до ' . $period_of_execution .
                ' - ' . $model->customer->full_name .
                ' - ' . $model->workObject->house_address;
        }),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Заказ') ?>

    <?= $form->field($model, 'brigade_gathering_datetime')->widget(
        DateTimePicker::className(),
        [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy hh:ii',
                'todayBtn' => true,
            ]
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
