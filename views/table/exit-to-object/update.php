<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\ExitToObject */

$this->title = 'Редактировать выход на объект: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Выходы на объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="exit-to-object-update">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-3"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
