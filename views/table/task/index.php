<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';
?>

<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать задачу', ['create'], [
            'class' => 'btn btn-success',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по задачам',
            ['report/task/index'],
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

            'text',
            ['attribute' => 'cost', 'label' => 'Стоимость услуги, руб.'],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
