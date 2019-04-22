<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Task */

$this->title = 'Редактировать задачу: ' . $model->text;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->text, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="task-update">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-3"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
