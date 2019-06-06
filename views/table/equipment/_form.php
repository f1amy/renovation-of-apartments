<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\table\Item;
use app\models\table\ExitToObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($model, 'item_id')->dropDownList(ArrayHelper::map(
        Item::find()->all(),
        'id',
        function ($model) {
            return 'Инв. №' . $model->id . ' - ' . $model->name .
                ' - Остаток ' . $model->quantity . ' шт.';
        }
    ), ['prompt' => 'Выберите значение...'])->label('Вещь') ?>

    <?= $form->field($model, 'exit_to_object_id')->dropDownList(
        ArrayHelper::map(
            ExitToObject::find()->all(),
            'id',
            function ($model) {
                return 'Дата выхода ' . $model->brigade_gathering_datetime .
                    ' - Место ' . $model->order->workObject->house_address;
            }
        ),
        ['prompt' => 'Выберите значение...']
    )->label('Выход на объект') ?>

    <?= $form->field($model, 'item_quantity')
        ->input('number', ['step' => '1', 'min' => '0']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
