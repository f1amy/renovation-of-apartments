<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склады';
?>

<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать склад', ['create'], [
            'id' => 'createWarehouse',
            'class' => 'btn btn-success mb-3',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по складам',
            ['report/warehouse/index'],
            [
                'class' => 'btn btn-primary mb-3',
            ]
        ) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateWarehouse',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createWarehouse, #gridWarehouse a[aria-label="Изменить"]',
        'pjaxContainer' => '#gridWarehouse-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'id' => 'gridWarehouse',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
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
</div>
