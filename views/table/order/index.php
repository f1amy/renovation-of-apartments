<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';

$this->registerJs(
    "
    $(document).ready(function () {
        $('#tooltip-link[data-toggle=\"tooltip\"]').tooltip();
    });
    ",
    $this::POS_READY,
    'init-tooltip'
);
?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать заказ', ['create'], [
            'id' => 'createOrder',
            'class' => 'btn btn-success mb-3 mr-2',
        ]) ?>
        <?= Html::a(FAS::icon('file-alt') .
            ' Форма создания заказа', ['form/order/create'], [
            'class' => 'btn btn-info mb-3',
        ]) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateOrder',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createOrder, #gridOrder a[aria-label="Изменить"]',
        'pjaxContainer' => '#gridOrder-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'id' => 'gridOrder',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'contract_date',
                'format' => 'date',
                'filterType' => '\kartik\datetime\DateTimePicker',
                'filterWidgetOptions' => [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'minView' => 2,
                        'todayBtn' => true,
                    ]
                ]
            ],
            [
                'attribute' => 'period_of_execution',
                'format' => 'date',
                'filterType' => '\kartik\datetime\DateTimePicker',
                'filterWidgetOptions' => [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'minView' => 2,
                        'todayBtn' => true,
                    ]
                ]
            ],
            [
                'attribute' => 'customer',
                'value' => 'customer.full_name',
                'label' => 'ФИО заказчика',
            ],
            [
                'attribute' => 'workObject',
                'value' => 'workObject.house_address',
                'label' => 'Адрес дома',
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'filterType' => '\kartik\select2\Select2',
                'filterWidgetOptions' => [
                    'hideSearch' => true,
                    'data' => [
                        'В работе' => 'В работе',
                        'Завершено' => 'Завершено',
                        'Отменено' => 'Отменено',
                    ],
                    'options' => [
                        'prompt' => 'Выберите...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ],
            [
                'attribute' => 'partialCost',
                'format' => 'currency',
                'header' => '<a id="tooltip-link" href="#" class="text-info text-center ' .
                    'd-inline-block" data-toggle="tooltip" data-placement="bottom" ' .
                    'title="При расчете учтены задачи с ед. изм. Комплект и ' .
                    'Штука, а так же Материалы и Расходуемое">' .
                    FAS::icon('exclamation-circle') . ' Частичная сумма</a>',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{formUpdate} {update} {delete}',
                'header' => 'Действия',
                'buttons' => [
                    'formUpdate' => function ($url, $model) {
                        return Html::a(
                            FAS::icon('file-alt'),
                            yii\helpers\Url::to(['form/order/update', 'id' => $model->id]),
                            [
                                'title' => 'Изменить на форме',
                                'aria-label' => 'Изменить на форме',
                                'data-pjax' => '0',
                            ]
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
