<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
?>

<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать задачу', ['create'], [
            'id' => 'createTask',
            'class' => 'btn btn-success mb-3',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по задачам',
            ['report/task/index'],
            [
                'class' => 'btn btn-primary mb-3',
            ]
        ) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateTask',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createTask, #w0-pjax a[aria-label="Изменить"]',
        'pjaxContainer' => '#w0-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'text',
            'cost:currency',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
