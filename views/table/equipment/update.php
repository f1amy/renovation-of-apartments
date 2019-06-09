<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Equipment */

$this->title = 'Редактировать снаряжение: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Снаряжения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="equipment-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
