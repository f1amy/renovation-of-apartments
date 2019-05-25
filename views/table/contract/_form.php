<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;
//use dosamigos\datetimepicker\DateTimePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\table\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-sm-6']]); ?>

    <?= $form->field($model, 'number')->input('number', ['step' => '1', 'min' => '0']) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        /* 'language' => 'ru',
        'template' => '{button}{reset}{input}', */
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'minView' => 2,
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
