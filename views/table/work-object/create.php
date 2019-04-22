<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\WorkObject */

$this->title = 'Создать рабочий объект';
$this->params['breadcrumbs'][] = ['label' => 'Рабочие объекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-object-create">

    <div class="row">
        <h1 class="col-sm-5 col-sm-offset-3"><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
