<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Equipment */

$this->title = 'Редактировать снаряжение: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Снаряжения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="equipment-update">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
