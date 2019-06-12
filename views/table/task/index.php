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
        'selector' => '#createTask, #gridTask a[aria-label="Изменить"]',
        'pjaxContainer' => '#gridTask-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'id' => 'gridTask',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'category',
                'format' => 'text',
                'filterType' => '\kartik\select2\Select2',
                'filterWidgetOptions' => [
                    'hideSearch' => true,
                    'data' => [
                        'Потолок' => 'Потолок',
                        'Стены' => 'Стены',
                        'Пол' => 'Пол',
                        'Коммуникации' => 'Коммуникации',
                        'Демонтаж' => 'Демонтаж',
                        'Остальное' => 'Остальное',
                    ],
                    'options' => [
                        'prompt' => 'Выберите значение...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ],
            'text',
            [
                'attribute' => 'unit',
                'format' => 'text',
                'filterType' => '\kartik\select2\Select2',
                'filterWidgetOptions' => [
                    'hideSearch' => true,
                    'data' => [
                        'Квадратный метр' => 'Квадратный метр',
                        'Штука' => 'Штука',
                        'Погонный метр' => 'Погонный метр',
                        'Комплект' => 'Комплект',
                        'Не применимо' => 'Не применимо',
                    ],
                    'options' => [
                        'prompt' => 'Выберите значение...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ],
            [
                'attribute' => 'cost_per_unit',
                'format' => 'currency',
                'label' => 'Стоимость за ед.',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
