<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Форма создания заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['table/order/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-form-create">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-2"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'contract' => $contract,
        'customer' => $customer,
        'workObject' => $workObject,
    ]) ?>

</div>
