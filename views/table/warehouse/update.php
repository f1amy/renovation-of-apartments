<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Warehouse */

$this->title = 'Изменить склад: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="warehouse-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
