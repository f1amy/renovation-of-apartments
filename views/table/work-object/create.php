<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkObject */

$this->title = 'Создать рабочий объект';
$this->params['breadcrumbs'][] = ['label' => 'Рабочие объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-object-create">

    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
