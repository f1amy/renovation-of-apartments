<?php

use kartik\grid\GridView;
use yii\helpers\Html;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
?>

<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать сотрудника', ['create'], [
            'class' => 'btn btn-success',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по сотрудникам',
            ['report/employee/index'],
            [
                'class' => 'btn btn-primary',
            ]
        ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'full_name',
            'position',
            'phone_number',
            'email_address:email',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
