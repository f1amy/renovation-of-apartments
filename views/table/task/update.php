<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Task */

$this->title = 'Изменить задачу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="task-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
