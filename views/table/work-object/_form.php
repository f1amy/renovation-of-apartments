<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-object-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-sm-6']]); ?>

    <?= $form->field($model, 'house_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apartment_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'entrance_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'floor_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
