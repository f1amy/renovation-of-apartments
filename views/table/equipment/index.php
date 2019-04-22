<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\EquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Снаряжения';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/

$actionsTemplate = '<div class="wrap-align-cell">{view}{update}{delete}</div>';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '<div class="wrap-align-cell">{view}</div>';
}
?>

<div class="equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus', 'aria-hidden' => 'true']) .
                ' Создать снаряжение', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
        <?php // echo Html::button('Поиск', ['class' => 'btn btn-primary',
            // 'data-toggle' => 'collapse', 'data-target' => '#search-collapse']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['rowspan' => 2]],

            'id',
            'item_id',
            [
                'attribute' => 'item',
                'value' => 'item.name',
                'label' => 'Наименование вещи',
            ],
            'exit_to_object_id',
            [
                'attribute' => 'exitToObject',
                'value' => 'exitToObject.brigade_gathering_datetime',
                'label' => 'Дата и время сбора бригады',
            ],
            ['attribute' => 'item_quantity', 'label' => 'Количество вещей, шт.'],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $actionsTemplate,
                'header' => 'Действия', 'headerOptions' => ['rowspan' => 2]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
