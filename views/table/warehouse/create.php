<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Warehouse */

$this->title = 'Создать склад';
$this->params['breadcrumbs'][] = ['label' => 'Склады', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="warehouse-create">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
