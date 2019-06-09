<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Warehouse */

$this->title = 'Создать склад';
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="warehouse-create">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
