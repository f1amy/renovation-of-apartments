<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Order */

$this->title = 'Изменить заказ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="order-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
