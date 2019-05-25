<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\WorkTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рабочие задачи';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/

$actionsTemplate = '{update} {delete}';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '';
}
?>

<div class="work-task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать рабочую задачу', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
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
            'task_id',
            [
                'attribute' => 'task',
                'value' => 'task.text',
                'label' => 'Текст задачи',
            ],
            'exit_to_object_id',
            [
                'attribute' => 'exitToObject',
                'value' => 'exitToObject.brigade_gathering_datetime',
                'label' => 'Дата и время сбора бригады',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => $actionsTemplate,
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2] */
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
