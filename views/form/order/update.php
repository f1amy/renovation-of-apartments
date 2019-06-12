<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Изменить заказ: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['table/order/index']];
$this->params['breadcrumbs'][] = ['label' => $order->id];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="order-form-update">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'order' => $order,
        'customer' => $customer,
        'workObject' => $workObject,
    ]) ?>

</div>
