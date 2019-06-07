<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;
use kartik\datetime\DateTimePicker;

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

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать ремонтную бригаду', ['create'], [
                'class' => 'btn btn-success',
            ]);
        }
        ?>
    </p>

    <?php Pjax::begin(); ?>

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
                'format' => 'datetime',
                'label' => 'Дата и время сбора бригады',
                'filter' => DateTimePicker::widget([
                    'name' => 'RenovatingBrigadeSearch[exitToObject]',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy hh:ii',
                        'todayBtn' => true,
                    ]
                ])
            ],
            [
                'attribute' => 'workObject',
                'value' => 'workObject.house_address',
                'label' => 'Адрес рабочего объекта'
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
