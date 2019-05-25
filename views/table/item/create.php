<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Item */

$this->title = 'Создать вещь';
$this->params['breadcrumbs'][] = ['label' => 'Вещи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item-create">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
