<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\table\Customer */

$this->title = 'Создать заказчика';
$this->params['breadcrumbs'][] = ['label' => 'Заказчики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <div>
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
