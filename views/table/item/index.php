<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вещи на складах';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>

<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать вещь', ['create'], ['class' => 'btn btn-success']) ?>
        <?php /* echo Html::button('Поиск', ['class' => 'btn btn-primary',
            'data-toggle' => 'collapse', 'data-target' => '#search-collapse']) */ ?>
    </p>

    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', /* 'headerOptions' => ['rowspan' => 2] */ ],

            [
                'label' => 'Инв. номер',
                'attribute' => 'id',
            ],
            //'warehouse_id',
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
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2] */
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
