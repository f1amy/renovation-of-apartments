<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\RenovatingBrigadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ремонтные бригады';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/

$actionsTemplate = '<div class="wrap-align-cell">{view}{update}{delete}</div>';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '<div class="wrap-align-cell">{view}</div>';
}
?>

<div class="renovating-brigade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus', 'aria-hidden' => 'true']) .
                ' Создать ремонтную бригаду', ['create'], ['class' => 'btn btn-success']);
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
            'employee_id',
            [
                'attribute' => 'employee',
                'value' => 'employee.full_name',
                'label' => 'ФИО сотрудника',
            ],
            'exit_to_object_id',
            [
                'attribute' => 'exitToObject',
                'value' => 'exitToObject.brigade_gathering_datetime',
                'label' => 'Дата и время сбора бригады',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $actionsTemplate,
                'header' => 'Действия', 'headerOptions' => ['rowspan' => 2]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
