<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\table\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'number')->input('number', ['step' => '1', 'min' => '0']) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'template' => '{button}{reset}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'minView' => 2,
            'todayBtn' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
