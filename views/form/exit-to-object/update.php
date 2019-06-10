<?php

use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;
use kartik\grid\GridView;
use yii\bootstrap4\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\table\Order;

/* @var $this yii\web\View */

$this->title = 'Редактировать выход на объект: ' . $exitToObject->id;
$this->params['breadcrumbs'][] = [
    'label' => 'Выходы на объекты',
    'url' => ['table/exit-to-object/index']
];
$this->params['breadcrumbs'][] = ['label' => $exitToObject->id];
$this->params['breadcrumbs'][] = 'Редактировать';

$this->registerJs("
    $(
        '#createUpdateRenovatingBrigade,' +
        '#createUpdateWorkTask,' +
        '#createUpdateEquipment'
    ).on(
        'kbModalShow',
        function(event, data, status, xhr, selector) {
            let formGroup = $(event.target).find(
                'select[name$=\"[exit_to_object_id]\"]'
            );
            formGroup = formGroup.closest('.form-group');
            const select2 = formGroup.find('select');
            select2.val('$exitToObject->id').trigger('change');
        });
");
?>

<div class="order-form-update">

    <div class="col-lg-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <?php $form = ActiveForm::begin(
                ['options' => ['class' => 'col-lg-6']]
            ); ?>

            <div class="form-group">
                <?= $form->field($exitToObject, 'order_id')->widget(
                    Select2::classname(),
                    [
                        'data' => ArrayHelper::map(
                            Order::find()->all(),
                            'id',
                            function ($model) {
                                return 'Договор №' . $model->id . ' от ' .
                                    $model->contract_date;
                            }
                        ),
                        'options' => ['prompt' => 'Выберите значение...'],
                    ]
                )->label('Заказ') ?>

                <?= $form->field($exitToObject, 'brigade_gathering_datetime')
                    ->widget(
                        DateTimePicker::className(),
                        [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy hh:ii',
                                'todayBtn' => true,
                            ]
                        ]
                    ) ?>
            </div>

            <div>
                <?= Html::submitButton(FAS::icon('check') .
                    ' Сохранить', [
                    'class' => 'btn btn-success mr-2 mb-3'
                ]) ?>

                <?= Html::a(
                    FAS::icon('arrow-left') . ' Назад к таблице',
                    Url::to('/table/exit-to-object'),
                    ['class' => 'btn btn-secondary mb-3']
                ) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="customerFullName">ФИО заказчика</label>
                    <?php
                    $order = Order::findOne(['id' => $exitToObject->order_id]);
                    $customerFullName = $order->customer->full_name;
                    $workObjectHouseAddress = $order->workObject->house_address;
                    ?>
                    <?= Html::input('text', null, $customerFullName, [
                        'id' => 'customerFullName',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]) ?>
                </div>
                <div class="form-group">
                    <label for="workObjectHouseAddress">Адрес рабочего объекта</label>
                    <?= Html::input('text', null, $workObjectHouseAddress, [
                        'id' => 'workObjectHouseAddress',
                        'class' => 'form-control',
                        'readonly' => 'readonly'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <h3>Ремонтная бригада</h3>
                <div>
                    <?= Html::a(
                        FAS::icon('plus') .
                            ' Создать ремонтную бригаду',
                        [Url::to('/table/renovating-brigade/create')],
                        [
                            'id' => 'createRenovatingBrigade',
                            'class' => 'btn btn-success mb-3',
                        ]
                    ) ?>
                </div>
                <?= ModalAjax::widget([
                    'id' => 'createUpdateRenovatingBrigade',
                    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                    'selector' => '#createRenovatingBrigade,' .
                        '#renovating-brigade-gridview a[aria-label="Изменить"]',
                    'pjaxContainer' => '#renovating-brigade-gridview-pjax',
                    'autoClose' => true,
                ]) ?>
                <?= GridView::widget([
                    'id' => 'renovating-brigade-gridview',
                    'dataProvider' => $renovatingBrigadeDataProvider,
                    'filterModel' => $renovatingBrigadeSearchModel,
                    'pjax' => true,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],

                        [
                            'attribute' => 'employee',
                            'value' => 'employee.full_name',
                            'label' => 'ФИО сотрудника',
                        ],

                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'header' => 'Действия',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a(
                                        FAS::icon('pencil-alt'),
                                        Url::to([
                                            'table/renovating-brigade/update',
                                            'id' => $model->id
                                        ]),
                                        [
                                            'title' => 'Изменить',
                                            'aria-label' => 'Изменить',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                                'delete' => function ($url, $model) use ($exitToObject) {
                                    return Html::a(
                                        FAS::icon('trash-alt'),
                                        Url::to([
                                            'form/exit-to-object/delete',
                                            'id' => $model->id,
                                            'table' => 'renovating-brigade',
                                            'returnId' => $exitToObject->id
                                        ]),
                                        [
                                            'title' => 'Удалить',
                                            'aria-label' => 'Удалить',
                                            'data-pjax' => '0',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Вы действительно' .
                                                ' хотите удалить данную запись?',
                                            'onclick'=> "$."
                                        ]
                                    );
                                },
                            ],
                        ]
                    ]
                ]) ?>
            </div>
            <div class="col-lg-6">
                <h3>Рабочие задачи</h3>
                <div>
                    <?= Html::a(
                        FAS::icon('plus') .
                            ' Создать рабочую задачу',
                        [Url::to('table/work-task/create')],
                        [
                            'id' => 'createWorkTask',
                            'class' => 'btn btn-success mb-3',
                        ]
                    ) ?>
                </div>
                <?= ModalAjax::widget([
                    'id' => 'createUpdateWorkTask',
                    'selector' => '#createWorkTask,' .
                        '#work-task-gridview a[aria-label="Изменить"]',
                    'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
                    'pjaxContainer' => '#work-task-gridview-pjax',
                    'autoClose' => true,
                ]) ?>
                <?= GridView::widget([
                    'id' => 'work-task-gridview',
                    'dataProvider' => $workTaskDataProvider,
                    'filterModel' => $workTaskSearchModel,
                    'pjax' => true,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],

                        [
                            'attribute' => 'task',
                            'value' => 'task.text',
                            'label' => 'Текст задачи',
                        ],

                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'header' => 'Действия',
                            'buttons' => [
                                'update' => function ($url, $model) {
                                    return Html::a(
                                        FAS::icon('pencil-alt'),
                                        Url::to([
                                            'table/work-task/update',
                                            'id' => $model->id
                                        ]),
                                        [
                                            'title' => 'Изменить',
                                            'aria-label' => 'Изменить',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                                'delete' => function ($url, $model) use ($exitToObject) {
                                    return Html::a(
                                        FAS::icon('trash-alt'),
                                        Url::to([
                                            'form/exit-to-object/delete',
                                            'id' => $model->id,
                                            'table' => 'work-task',
                                            'returnId' => $exitToObject->id
                                        ]),
                                        [
                                            'title' => 'Удалить',
                                            'aria-label' => 'Удалить',
                                            'data-pjax' => '0',
                                            'data-method' => 'post',
                                            'data-confirm' => 'Вы действительно' .
                                                ' хотите удалить данную запись?',
                                        ]
                                    );
                                },
                            ],
                        ]
                    ]
                ]) ?>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <h3>Снаряжение</h3>
        <div>
            <?= Html::a(
                FAS::icon('plus') .
                    ' Создать снаряжение',
                [Url::to('table/equipment/create')],
                [
                    'id' => 'createEquipment',
                    'class' => 'btn btn-success mb-3',
                ]
            ) ?>
        </div>
        <?= ModalAjax::widget([
            'id' => 'createUpdateEquipment',
            'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
            'selector' => '#createEquipment,' .
                '#equipment-gridview a[aria-label="Изменить"]',
            'pjaxContainer' => '#equipment-gridview-pjax',
            'autoClose' => true,
        ]) ?>
        <?= GridView::widget([
            'id' => 'equipment-gridview',
            'dataProvider' => $equipmentDataProvider,
            'filterModel' => $equipmentSearchModel,
            'pjax' => true,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                [
                    'attribute' => 'item',
                    'value' => 'item.name',
                    'label' => 'Наименование вещи',
                ],
                [
                    'attribute' => 'item_quantity',
                    'label' => 'Количество вещей, шт.'
                ],

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'header' => 'Действия',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a(
                                FAS::icon('pencil-alt'),
                                Url::to([
                                    'table/equipment/update',
                                    'id' => $model->id
                                ]),
                                [
                                    'title' => 'Изменить',
                                    'aria-label' => 'Изменить',
                                    'data-pjax' => '0',
                                ]
                            );
                        },
                        'delete' => function ($url, $model) use ($exitToObject) {
                            return Html::a(
                                FAS::icon('trash-alt'),
                                Url::to([
                                    'form/exit-to-object/delete',
                                    'id' => $model->id,
                                    'table' => 'equipment',
                                    'returnId' => $exitToObject->id
                                ]),
                                [
                                    'title' => 'Удалить',
                                    'aria-label' => 'Удалить',
                                    'data-pjax' => '0',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Вы действительно' .
                                        ' хотите удалить данную запись?',
                                ]
                            );
                        },
                    ],
                ]
            ]
        ]) ?>
    </div>

</div>
