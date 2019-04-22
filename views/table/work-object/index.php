<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WorkObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рабочие объекты';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>
<div class="work-object-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus', 'aria-hidden' => 'true']) .
            ' Создать рабочий объект', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-file', 'aria-hidden' => 'true']) .
            ' Форма создания заказа', ['form/order/create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['rowspan' => 2]],

            'id',
            'house_address',
            'apartment_number',
            'entrance_number',
            'floor_number',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="wrap-align-cell">{view}{update}{delete}</div>',
                'header' => 'Действия', 'headerOptions' => ['rowspan' => 2],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
