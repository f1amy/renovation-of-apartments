<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Customer */

$this->title = 'Изменить заказчика: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="customer-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
