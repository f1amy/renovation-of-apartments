<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Форма создания выхода на объект';
$this->params['breadcrumbs'][] = ['label' => 'Выходы на объекты', 'url' => ['table/exit-to-object/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-form-create">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'exitToObject' => $exitToObject,
    ]) ?>

</div>
