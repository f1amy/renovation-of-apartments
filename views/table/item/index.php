<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

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

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ['attribute' => 'quantity', 'label' => 'Количество, шт.'],
            ['attribute' => 'purchase_price', 'label' => 'Цена покупки, руб.'],
            'type',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
