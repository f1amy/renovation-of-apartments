<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus', 'aria-hidden' => 'true']) .
            ' Создать договор', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-file', 'aria-hidden' => 'true']) .
            ' Форма создания заказа', ['form/order/create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['rowspan' => 2]],

            'id',
            'number',
            'date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="wrap-align-cell">{view}{update}{formUpdate}{delete}</div>',
                'header' => 'Действия', 'headerOptions' => ['rowspan' => 2],
                'buttons' => [
                    'formUpdate' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-file"></span>',
                            yii\helpers\Url::to(['form/order/update', 'id' => $model->order->id]),
                            [
                                'title' => 'Редактировать на форме',
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
