<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\ExitToObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выходы на объекты';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/

$actionsTemplate = '<div class="wrap-align-cell">{view}{update}{delete}</div>';

if (\Yii::$app->user->can('brigadeWorker')) {
    $actionsTemplate = '<div class="wrap-align-cell">{view}</div>';
}
?>

<div class="exit-to-object-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?php
        if (!\Yii::$app->user->can('brigadeWorker')) {
            echo Html::a(FAS::icon('plus') .
                ' Создать выход на объект', ['create'], ['class' => 'btn btn-success']);
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
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['rowspan' => 2]],

            'id',
            'order_id',
            [
                'attribute' => 'brigade_gathering_datetime',
                'format' => ['datetime', 'php:Y-m-d H:i'],
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
