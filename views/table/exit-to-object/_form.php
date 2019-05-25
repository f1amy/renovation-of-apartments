<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
//use dosamigos\datetimepicker\DateTimePicker;
use kartik\datetime\DateTimePicker;

use app\models\table\Order;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exit-to-object-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-sm-6']]); ?>

    <?= $form->field($model, 'order_id')->dropDownList(
        ArrayHelper::map(Order::find()->all(), 'id', function ($model) {
            return 'Код ' . $model->id . ' - Договор №' . $model->contract->number .
                ' от ' . $model->contract->date;
        }),
        ['prompt' => 'Выберите значение...']
    ) ?>

    <?= $form->field($model, 'brigade_gathering_datetime')->widget(DateTimePicker::className(), [
        /* 'language' => 'ru',
        'template' => '{button}{reset}{input}', */
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
