<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вещи на складах';
?>

<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать вещь', ['create'], [
            'class' => 'btn btn-success',
        ]) ?>
    </p>

    <?= GridView::widget([
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
            'type',
            ['attribute' => 'quantity', 'label' => 'Количество, шт.'],
            'purchase_price:currency',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
