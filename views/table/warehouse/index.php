<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склады';
?>

<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать склад', ['create'], [
            'class' => 'btn btn-success',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по складам',
            ['report/warehouse/index'],
            [
                'class' => 'btn btn-primary',
            ]
        ) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'name',
            'address',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
