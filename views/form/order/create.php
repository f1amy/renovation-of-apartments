<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Форма создания заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['table/order/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-form-create">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'contract' => $contract,
        'customer' => $customer,
        'workObject' => $workObject,
    ]) ?>

</div>
