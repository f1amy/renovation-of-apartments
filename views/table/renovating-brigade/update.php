<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\RenovatingBrigade */

$this->title = 'Редактировать ремонтную бригаду: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ремонтные бригады', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="renovating-brigade-update">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-3"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
