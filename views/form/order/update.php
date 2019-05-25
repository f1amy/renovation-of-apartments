<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Редактировать заказ: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['table/order/index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['table/order/view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="order-form-update">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'order' => $order,
        'contract' => $contract,
        'customer' => $customer,
        'workObject' => $workObject,
    ]) ?>

</div>
