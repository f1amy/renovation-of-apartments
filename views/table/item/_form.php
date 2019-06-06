<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\table\Warehouse;

/* @var $this yii\web\View */
/* @var $model app\models\table\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg-6']]); ?>

    <?= $form->field($model, 'warehouse_id')->dropDownList(
        ArrayHelper::map(
            Warehouse::find()->all(),
            'id',
            function ($model) {
                return $model->name . ' - Адрес ' . $model->address;
            }),
        ['prompt' => 'Выберите значение...']
    )->label('Склад') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->input('number', ['min' => '0', 'step' => '1']) ?>

    <?= $form->field($model, 'purchase_price')->input('number', ['min' => '0', 'step' => '0.01']) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'Инструмент' => 'Инструмент',
        'Материал' => 'Материал'
    ], ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
