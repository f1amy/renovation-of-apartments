<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\RenovatingBrigadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ремонтные бригады';

$actionsTemplate = '{update} {delete}';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '';
}
?>

<div class="renovating-brigade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать ремонтную бригаду', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'employee',
                'value' => 'employee.full_name',
                'label' => 'ФИО сотрудника',
            ],
            [
                'attribute' => 'exitToObject',
                'value' => 'exitToObject.brigade_gathering_datetime',
                'label' => 'Дата и время сбора бригады',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => $actionsTemplate,
                'header' => 'Действия',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
