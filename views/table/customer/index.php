<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FAS;

//use app\models\table\Order; // ??? it was here

/* @var $this yii\web\View */
/* @var $searchModel app\models\table\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказчики';

/*if (!$this->params['useSideNavInsteadOfBreadcrumbs']) {
    $this->params['breadcrumbs'][] = $this->title;
}*/
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php /* echo $this->render('_search', ['model' => $searchModel]); */ ?>

    <p>
        <?= Html::a(FAS::icon('plus') .
            ' Создать заказчика', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(FAS::icon('file-alt') .
            ' Форма создания заказа', ['form/order/create'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', /* 'headerOptions' => ['rowspan' => 2] */ ],

            'id',
            'full_name',
            'phone_number',
            'email_address:email',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия', /* 'headerOptions' => ['rowspan' => 2], */
                'template' => '{formUpdate} {update} {delete}',
                'buttons' => [
                    'formUpdate' => function ($url, $model) {
                        return Html::a(
                            FAS::icon('file-alt'),
                            yii\helpers\Url::to(['form/order/update', 'id' => $model->id]),
                            [
                                'title' => 'Изменить на форме',
                                'aria-label' => 'Изменить на форме',
                                'data-pjax' => '0',
                            ]
                        );
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
