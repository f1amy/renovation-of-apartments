<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

use app\models\table\Order;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exit-to-object-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($model, 'order_id')->dropDownList(
        ArrayHelper::map(Order::find()->all(), 'id', function ($model) {
            return 'Договор №' . $model->id . ' от ' . $model->contract_date .
                ' - ' . $model->customer->full_name .
                ' - ' . $model->workObject->house_address;
        }),
        ['prompt' => 'Выберите значение...']
    )->label('Заказ') ?>

    <?= $form->field($model, 'brigade_gathering_datetime')->widget(DateTimePicker::className(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayBtn' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
