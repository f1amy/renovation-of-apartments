<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\table\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

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

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
