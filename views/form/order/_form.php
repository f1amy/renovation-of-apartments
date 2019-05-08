<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\table\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="row">
        <h3 class="col-sm-3 col-sm-offset-3">Договор</h3>
    </div>
    <div class="form-group">
        <?= $form->field($contract, 'number')->input('number', ['step' => '1', 'min' => '0']) ?>

        <?= $form->field($contract, 'date')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'template' => '{button}{reset}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'minView' => 2,
                'todayBtn' => true,
            ]
        ]) ?>
    </div>

    <div class="row">
        <h3 class="col-sm-3 col-sm-offset-3">Заказчик</h3>
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
        <h3 class="col-sm-3 col-sm-offset-3">Рабочий объект</h3>
    </div>
    <div class="form-group">
        <?= $form->field($workObject, 'house_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($workObject, 'apartment_number')->input('number', ['min' => 0, 'step' => 1]) ?>

        <?= $form->field($workObject, 'entrance_number')->input('number', ['min' => 0, 'step' => 1]) ?>

        <?= $form->field($workObject, 'floor_number')->input('number', ['min' => 0, 'step' => 1]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
