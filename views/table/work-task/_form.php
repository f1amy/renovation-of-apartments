<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;

use app\models\table\Task;
use app\models\table\ExitToObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-task-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'task_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(
            Task::find()->all(),
            'id',
            function ($model) {
                return $model->text;
            }
        ),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Задача') ?>

    <?= $form->field($model, 'exit_to_object_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(
            ExitToObject::find()->all(),
            'id',
            function ($model) {
                return 'Дата выхода ' . $model->brigade_gathering_datetime .
                    ' - Место ' . $model->order->workObject->house_address;
            }
        ),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Выход на объект') ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
