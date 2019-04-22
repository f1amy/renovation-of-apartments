<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkTask */

$this->title = 'Создать рабочую задачу';
$this->params['breadcrumbs'][] = ['label' => 'Рабочие задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="work-task-create">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-3"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
