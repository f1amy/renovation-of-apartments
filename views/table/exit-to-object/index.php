<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\datetime\DateTimePicker;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ExitToObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выходы на объекты';

$actionsTemplate = '{update} {delete}';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '';
}
?>

<div class="exit-to-object-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать выход на объект', ['create'], [
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

            'order_id',
            [
                'attribute' => 'brigade_gathering_datetime',
                'format' => ['datetime', 'php:Y-m-d H:i'],
                'filter' => DateTimePicker::widget([
                    'name' => 'ExitToObjectSearch[brigade_gathering_datetime]',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii:ss',
                        'todayBtn' => true,
                    ]
                ])
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
