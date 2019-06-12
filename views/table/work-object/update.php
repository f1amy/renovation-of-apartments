<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkObject */

$this->title = 'Изменить рабочий объект: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Рабочие объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="work-object-update">

    <div class="col-lg">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
