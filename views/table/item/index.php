<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вещи на складах';
?>

<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать вещь', ['create'], [
            'id' => 'createItem',
            'class' => 'btn btn-success mb-3',
        ]) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateItem',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createItem, #gridItem a[aria-label="Изменить"]',
        'pjaxContainer' => '#gridItem-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'id' => 'gridItem',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => 'Инв. номер',
                'attribute' => 'id',
            ],
            [
                'attribute' => 'warehouse',
                'value' => 'warehouse.name',
                'label' => 'Наименование склада',
            ],
            'name',
            [
                'attribute' => 'type',
                'format' => 'text',
                'filterType' => '\kartik\select2\Select2',
                'filterWidgetOptions' => [
                    'hideSearch' => true,
                    'data' => [
                        'Инструмент' => 'Инструмент',
                        'Материал' => 'Материал',
                        'Расходуемое' => 'Расходуемое',
                        'Другое' => 'Другое',
                    ],
                    'options' => [
                        'prompt' => 'Выберите...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ],
            'quantity',
            'purchase_price:currency',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
