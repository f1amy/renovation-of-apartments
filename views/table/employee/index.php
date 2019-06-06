<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
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
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'full_name',
            'phone_number',
            'email_address:email',
            'position',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
