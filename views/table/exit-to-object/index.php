<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ExitToObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выходы на объекты';

$gridViewColumns = [
    ['class' => 'kartik\grid\SerialColumn'],

    [
        'attribute' => 'order_id',
        'label' => 'Номер договора'
    ],
    [
        'attribute' => 'customer',
        'value' => 'customer.full_name',
        'label' => 'ФИО заказчика'
    ],
    [
        'attribute' => 'brigade_gathering_datetime',
        'format' => 'datetime',
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
                        'id' => $model->id
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

<div class="exit-to-object-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать выход на объект', ['create'], [
                'id' => 'createExitToObject',
                'class' => 'btn btn-success mb-3 mr-2',
            ]);
            echo ModalAjax::widget([
                'id' => 'createUpdateExitToObject',
                'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                'selector' => '#createExitToObject, #w0-pjax a[aria-label="Изменить"]',
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
