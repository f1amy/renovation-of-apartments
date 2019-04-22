<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>

<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus', 'aria-hidden' => 'true']) .
            ' Создать сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
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
            'full_name',
            'phone_number',
            'email_address:email',
            'position',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="wrap-align-cell">{view}{update}{delete}</div>',
                'header' => 'Действия', 'headerOptions' => ['rowspan' => 2]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
