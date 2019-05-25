<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Equipment */

$this->title = 'Создать снаряжение';
$this->params['breadcrumbs'][] = ['label' => 'Снаряжения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="equipment-create">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
