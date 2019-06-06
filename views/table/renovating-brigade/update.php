<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\RenovatingBrigade */

$this->title = 'Редактировать ремонтную бригаду: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ремонтные бригады', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="renovating-brigade-update">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
