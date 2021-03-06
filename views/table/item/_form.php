<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use rmrevin\yii\fontawesome\FAS;

use app\models\table\Warehouse;

/* @var $this yii\web\View */
/* @var $model app\models\table\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'warehouse_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(
            Warehouse::find()->all(),
            'id',
            function ($model) {
                return $model->name . ' - Адрес ' . $model->address;
            }
        ),
        'options' => ['prompt' => 'Выберите значение...'],
    ])->label('Склад') ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true,
        'placeholder' => 'Пример: Лобзик 770Вт Производитель Модель'
    ]) ?>

    <?= $form->field($model, 'quantity')->input('number', ['min' => '1', 'step' => '1']) ?>

    <?= $form->field($model, 'purchase_price')
        ->input('number', ['min' => '0', 'step' => '0.01'])
        ->label('Цена покупки, руб.') ?>

    <?= $form->field($model, 'type')->dropDownList([
        'Инструмент' => 'Инструмент',
        'Материал' => 'Материал',
        'Расходуемое' => 'Расходуемое',
        'Другое' => 'Другое',
    ], ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
