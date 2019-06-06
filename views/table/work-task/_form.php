<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\table\Task;
use app\models\table\ExitToObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-task-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($model, 'task_id')->dropDownList(
        ArrayHelper::map(
            Task::find()->all(),
            'id',
            function ($model) {
                return 'Код ' . $model->id . ' - ' . $model->text;
            }
        ),
        ['prompt' => 'Выберите значение...']
    ) ?>

    <?= $form->field($model, 'exit_to_object_id')->dropDownList(ArrayHelper::map(
        ExitToObject::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . $model->brigade_gathering_datetime;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
