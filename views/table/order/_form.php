<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\table\Contract;
use app\models\table\Customer;
use app\models\table\WorkObject;

/* @var $this yii\web\View */
/* @var $model app\models\table\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'contract_id')->dropDownList(ArrayHelper::map(
        Contract::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . '№' .
                $model->number . ' от ' . $model->date;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(
        Customer::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . $model->full_name;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <?= $form->field($model, 'work_object_id')->dropDownList(ArrayHelper::map(
        WorkObject::find()->all(),
        'id',
        function ($model) {
            return 'Код ' . $model->id . ' - ' . $model->house_address .
                ', кв. ' . $model->apartment_number;
        }
    ), ['prompt' => 'Выберите значение...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', [
            'class' => 'btn btn-success col-sm-1 col-sm-offset-3'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
