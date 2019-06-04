<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(FAS::icon('file-alt') .
            ' Форма создания заказа', ['form/order/create'], ['class' => 'btn btn-info']) ?>
        <?php /* echo Html::button('Поиск', ['class' => 'btn btn-primary',
            'data-toggle' => 'collapse', 'data-target' => '#search-collapse']) */ ?>
    </p>

    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', /* 'headerOptions' => ['rowspan' => 2] */ ],

            'id',
            //'contract_id',
            'contract_date',
            //'customer_id',
            [
                'attribute' => 'customer',
                'value' => 'customer.full_name',
                'label' => 'ФИО заказчика',
            ],
            //'work_object_id',
            [
                'attribute' => 'workObject',
                'value' => 'workObject.house_address',
                'label' => 'Адрес дома',
            ],
            [
                'attribute' => 'totalCost',
                'label' => 'Общая стоимость, руб.',
                'format' => ['decimal', 2],
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{formUpdate} {update} {delete}',
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2], */
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
