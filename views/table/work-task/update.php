<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkTask */

$this->title = 'Редактировать рабочую задачу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Рабочие задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="work-task-update">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
