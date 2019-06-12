<?php

use kartik\grid\GridView;
use yii\helpers\Html;

use rmrevin\yii\fontawesome\FAS;
use lo\widgets\modal\ModalAjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
?>

<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?= Html::a(FAS::icon('plus') .
            ' Создать сотрудника', ['create'], [
            'id' => 'createEmployee',
            'class' => 'btn btn-success mb-3',
        ]) ?>
        <?= Html::a(
            FAS::icon('chart-bar') .
                ' Отчет по сотрудникам',
            ['report/employee/index'],
            [
                'class' => 'btn btn-primary mb-3',
            ]
        ) ?>
    </div>

    <?= ModalAjax::widget([
        'id' => 'createUpdateEmployee',
        'bootstrapVersion' => ModalAjax::BOOTSTRAP_VERSION_4,
        'selector' => '#createEmployee, #gridEmployee a[aria-label="Изменить"]',
        'pjaxContainer' => '#gridEmployee-pjax',
        'autoClose' => true,
    ]) ?>

    <?= GridView::widget([
        'id' => 'gridEmployee',
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
