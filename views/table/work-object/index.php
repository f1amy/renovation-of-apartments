<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WorkObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рабочие объекты';
?>
<div class="work-object-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать рабочий объект', ['create'], [
            'id' => 'createWorkObject',
            'class' => 'btn btn-success mb-3',
        ]) ?>
        <?= Html::a(FAS::icon('file-alt') .
            ' Форма создания заказа', ['form/order/create'], [
            'class' => 'btn btn-info mb-3',
        ]) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateWorkObject',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createWorkObject, #w0-pjax a[aria-label="Изменить"]',
        'pjaxContainer' => '#w0-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'house_address',
            'apartment_number',
            'entrance_number',
            'floor_number',

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
