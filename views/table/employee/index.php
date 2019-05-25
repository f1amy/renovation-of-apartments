<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

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
        <?= Html::a(FAS::icon('plus') .
            ' Создать сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по сотрудникам',
            ['report/employee/index'],
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

            'id',
            'full_name',
            'phone_number',
            'email_address:email',
            'position',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2] */
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
