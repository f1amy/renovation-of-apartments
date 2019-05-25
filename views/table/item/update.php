<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Item */

$this->title = 'Редактировать вещь: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вещи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="item-update">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
