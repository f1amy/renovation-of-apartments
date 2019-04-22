<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkObject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-object-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'house_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apartment_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'entrance_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'floor_number')->input('number', ['min' => 0, 'step' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
