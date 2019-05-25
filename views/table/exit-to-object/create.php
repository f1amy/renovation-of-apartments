<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */

$this->title = 'Создать выход на объект';
$this->params['breadcrumbs'][] = ['label' => 'Выходы на объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="exit-to-object-create">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
