<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Task */

$this->title = 'Редактировать задачу: ' . $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->text];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="task-update">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
