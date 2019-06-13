<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;

use app\models\table\Item;
use app\models\table\ExitToObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'item_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(
            Item::find()->all(),
            'id',
            function ($model) {
                return $model->type . ' - ' . $model->name .
                    ' - Остаток ' . $model->quantity . ' шт.';
            }
        ),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Материал') ?>

    <?= $form->field($model, 'exit_to_object_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(
            ExitToObject::find()->all(),
            'id',
            function ($model) {
                $brigade_gathering_datetime = \Yii::$app->formatter
                    ->asDate($model->brigade_gathering_datetime, 'php:d.m.Y H:i');

                return 'Дата выхода ' . $brigade_gathering_datetime .
                    ' - Место ' . $model->order->workObject->house_address;
            }
        ),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Выход на объект') ?>

    <?= $form->field($model, 'item_quantity')
        ->input('number', ['step' => '1', 'min' => '1']) ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
