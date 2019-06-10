<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WorkTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рабочие задачи';

$gridViewColumns = [
    ['class' => 'kartik\grid\SerialColumn'],

    [
        'attribute' => 'task',
        'value' => 'task.text',
        'label' => 'Текст задачи',
    ],
    [
        'attribute' => 'exitToObject',
        'value' => 'exitToObject.brigade_gathering_datetime',
        'format' => 'datetime',
        'label' => 'Дата и время сбора бригады',
        'filterType' => '\kartik\datetime\DateTimePicker',
        'filterWidgetOptions' => [
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy hh:ii',
                'todayBtn' => true,
            ]
        ]
    ],
    [
        'attribute' => 'workObject',
        'value' => 'workObject.house_address',
        'label' => 'Адрес рабочего объекта'
    ],
];

if (!\Yii::$app->user->can('brigadeWorker')) {
    $gridViewColumns[] = [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{formUpdate} {update} {delete}',
        'header' => 'Действия',
        'buttons' => [
            'formUpdate' => function ($url, $model) {
                return Html::a(
                    FAS::icon('file-alt'),
                    yii\helpers\Url::to([
                        'form/exit-to-object/update',
                        'id' => $model->exit_to_object_id
                    ]),
                    [
                        'title' => 'Изменить на форме',
                        'aria-label' => 'Изменить на форме',
                        'data-pjax' => '0',
                    ]
                );
            }
        ],
    ];
}
?>

<div class="work-task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать рабочую задачу', ['create'], [
                'id' => 'createWorkTask',
                'class' => 'btn btn-success mb-3 mr-2',
            ]);
            echo ModalAjax::widget([
                'id' => 'createUpdateWorkTask',
                'selector' => '#createWorkTask, #w0-pjax a[aria-label="Изменить"]',
                'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                'pjaxContainer' => '#w0-pjax',
                'autoClose' => true,
            ]);
            echo Html::a(
                FAS::icon('file-alt') .
                    ' Форма создания выхода на объект',
                ['form/exit-to-object/create'],
                [
                    'class' => 'btn btn-info mb-3',
                ]
            );
        }
        ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => $gridViewColumns
    ]); ?>
</div>
