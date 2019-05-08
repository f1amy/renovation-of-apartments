<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\table\Employee;
use app\models\table\ExitToObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\RenovatingBrigade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="renovating-brigade-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'employee_id')->dropDownList(ArrayHelper::map(
        Employee::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . $model->full_name;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <?= $form->field($model, 'exit_to_object_id')->dropDownList(ArrayHelper::map(
        ExitToObject::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . $model->brigade_gathering_datetime;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
