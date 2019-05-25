<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\table\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($model, 'full_name')->textInput([
        'maxlength' => true,
        'pattern' => '^[А-Я][а-я]+ [А-Я][а-я]+ [А-Я][а-я]+$',
        'placeholder' => 'Фамилия Имя Отчество'
    ]) ?>

    <?= $form->field($model, 'phone_number')->widget(
        \yii\widgets\MaskedInput::className(),
        [
            'mask' => '+7 999 999-99-99',
        ]
    ) ?>

    <?= $form->field($model, 'email_address')->textInput([
        'maxlength' => true,
        'type' => 'email',
        'placeholder' => 'name@example.com'
    ]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
