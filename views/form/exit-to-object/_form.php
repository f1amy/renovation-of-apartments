<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\datetime\DateTimePicker;
use rmrevin\yii\fontawesome\FAS;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\table\Order;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exit-to-object-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <div class="form-group">
        <?= $form->field($exitToObject, 'order_id')->widget(Select2::classname(), [
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

        <?= $form->field($exitToObject, 'brigade_gathering_datetime')->widget(
            DateTimePicker::className(),
            [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy hh:ii',
                    'todayBtn' => true,
                ]
            ]
        ) ?>
    </div>

    <div>
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success mr-2 mb-3'
        ]) ?>

        <?= Html::a(
            FAS::icon('times') . ' Отмена',
            Yii::$app->request->referrer !== null ?
                Yii::$app->request->referrer : Yii::$app->homeUrl,
            ['class' => 'btn btn-danger mb-3']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
