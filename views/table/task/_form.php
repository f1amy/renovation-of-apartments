<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\table\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'col-lg']]); ?>

    <?= $form->field($model, 'category')->dropDownList([
        'Потолок' => 'Потолок',
        'Стены' => 'Стены',
        'Пол' => 'Пол',
        'Коммуникации' => 'Коммуникации',
        'Демонтаж' => 'Демонтаж',
        'Остальное' => 'Остальное',
    ], [
        'prompt' => 'Выберите значение...'
    ]) ?>

    <?= $form->field($model, 'text')->textInput([
        'maxlength' => true,
        'placeholder' => 'Пример: Замер помещений'
    ]) ?>

    <?= $form->field($model, 'unit')->dropDownList([
        'Квадратный метр' => 'Квадратный метр',
        'Штука' => 'Штука',
        'Погонный метр' => 'Погонный метр',
        'Комплект' => 'Комплект',
        'Не применимо' => 'Не применимо',
    ], [
        'prompt' => 'Выберите значение...'
    ]) ?>

    <?= $form->field($model, 'cost_per_unit')->input(
        'number',
        ['min' => '0', 'step' => '0.01'],
    )->label('Стоимость за единицу, руб.') ?>

    <div class="form-group">
        <?= Html::submitButton(FAS::icon('check') .
            ' Сохранить', [
            'class' => 'btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
