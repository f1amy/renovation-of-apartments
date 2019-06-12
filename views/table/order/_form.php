<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;

use app\models\table\Customer;
use app\models\table\WorkObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'contract_date')->widget(
        DateTimePicker::className(),
        [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy',
                'minView' => 2,
                'todayBtn' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'period_of_execution')->widget(
        DateTimePicker::className(),
        [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy',
                'minView' => 2,
                'todayBtn' => true,
            ]
        ]
    ) ?>

    <?= $form->field($model, 'customer_id')->widget(
        Select2::classname(),
        [
            'data' => ArrayHelper::map(
                Customer::find()->all(),
                'id',
                function ($model) {
                    return $model->full_name;
                }
            ),
            'options' => ['prompt' => 'Выберите значение...'],
        ]
    )->label('Заказчик') ?>

    <?= $form->field($model, 'work_object_id')->widget(
        Select2::classname(),
        [
            'data' => ArrayHelper::map(
                WorkObject::find()->all(),
                'id',
                function ($model) {
                    return $model->house_address .
                        ' -  Кв. ' . $model->apartment_number;
                }
            ),
            'options' => ['prompt' => 'Выберите значение...'],
        ]
    )->label('Рабочий объект') ?>

    <?= $form->field($model, 'status')->dropDownList([
        'В работе' => 'В работе',
        'Завершено' => 'Завершено',
        'Отменено' => 'Отменено',
    ], ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
