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

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <div class="row">
        <h3>Договор</h3>
    </div>
    <div class="form-group">
        <?= $form->field($order, 'contract_date')->widget(DateTimePicker::className(), [
            /* 'language' => 'ru',
            'template' => '{button}{reset}{input}', */
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'minView' => 2,
                'todayBtn' => true,
            ]
        ]) ?>
    </div>

    <div class="row">
        <h3>Заказчик</h3>
    </div>
    <div class="form-group">
        <?= $form->field($customer, 'full_name')->textInput([
            'maxlength' => true,
            'pattern' => '^[А-Я][а-я]+ [А-Я][а-я]+ [А-Я][а-я]+$',
            'placeholder' => 'Фамилия Имя Отчество'
        ]) ?>

        <?= $form->field($customer, 'phone_number')->widget(
            \yii\widgets\MaskedInput::className(),
            [
                'mask' => '+7 999 999-99-99',
            ]
        ) ?>

        <?= $form->field($customer, 'email_address')->textInput([
            'maxlength' => true,
            'type' => 'email',
            'placeholder' => 'name@example.com'
        ]) ?>
    </div>

    <div class="row">
        <h3>Рабочий объект</h3>
    </div>
    <div class="form-group">
        <?= $form->field($workObject, 'house_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($workObject, 'apartment_number')->input('number', ['min' => 0, 'step' => 1]) ?>

        <?= $form->field($workObject, 'entrance_number')->input('number', ['min' => 0, 'step' => 1]) ?>

        <?= $form->field($workObject, 'floor_number')->input('number', ['min' => 0, 'step' => 1]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
