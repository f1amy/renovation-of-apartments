<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Customer */

$this->title = 'Редактировать заказчика: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="customer-update">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
