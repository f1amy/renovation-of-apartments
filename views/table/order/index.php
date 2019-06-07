<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\datetime\DateTimePicker;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать заказ', ['create'], [
            'class' => 'btn btn-success',
        ]) ?>
        <?= Html::a(FAS::icon('file-alt') .
            ' Форма создания заказа', ['form/order/create'], [
            'class' => 'btn btn-info',
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'contract_date',
                'format' => 'date',
                'filter' => DateTimePicker::widget([
                    'name' => 'OrderSearch[contract_date]',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy',
                        'minView' => 2,
                        'todayBtn' => true,
                    ]
                ])
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
                'attribute' => 'totalCost',
                'label' => 'Общая стоимость',
                'format' => 'currency',
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
    <?php Pjax::end(); ?>
</div>
