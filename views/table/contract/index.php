<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Договоры';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать договор', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(FAS::icon('file') .
            ' Форма создания заказа', ['form/order/create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', /* 'headerOptions' => ['rowspan' => 2] */],

            'id',
            'number',
            'date',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {formUpdate} {delete}',
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2], */
                'buttons' => [
                    'formUpdate' => function ($url, $model) {
                        return Html::a(
                            FAS::icon('file'),
                            yii\helpers\Url::to(['form/order/update', 'id' => $model->order->id]),
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
