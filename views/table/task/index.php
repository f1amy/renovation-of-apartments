<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачи';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>

<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по задачам',
            ['report/task/index'],
            ['class' => 'btn btn-primary']
        ) ?>
        <?php /* echo Html::button('Поиск', ['class' => 'btn btn-primary',
            'data-toggle' => 'collapse', 'data-target' => '#search-collapse']) */ ?>
    </p>

    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', /* 'headerOptions' => ['rowspan' => 2] */],

            //'id',
            'text',
            ['attribute' => 'cost', 'label' => 'Стоимость услуги, руб.'],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2] */
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
