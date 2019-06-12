<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Item */

$this->title = 'Изменить вещь: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вещи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="item-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
