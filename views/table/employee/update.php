<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Employee */

$this->title = 'Изменить сотрудника: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="employee-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
