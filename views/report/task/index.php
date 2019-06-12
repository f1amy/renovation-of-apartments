<?php

use yii\helpers\Html;
use dosamigos\highcharts\HighCharts;
use yii\helpers\ArrayHelper;
use app\models\table\Task;
use app\models\table\WorkTask;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */

$this->title = 'Отчет по задачам';

$this->registerJs("
    $(document).ready(function () {
        let chart = Highcharts.charts[0];

        $('#toggle-legend').click(function () {
            chart.legend.update({
                enabled: !chart.legend.options.enabled,
            });
        });
    });
    ",
    $this::POS_READY,
    'toggle-chart-legend'
);
?>
<div class="report-task-index">

    <div class="form-group">
        <?= Html::a(
            FAS::icon('arrow-left') . ' Назад',
            Yii::$app->request->referrer !== null ?
                Yii::$app->request->referrer : Yii::$app->homeUrl,
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Этот отчет позволяет узнать спрос на выполняемые ремонтной бригадой задачи.</p>

    <div class="col mb-3">
        <button id="toggle-legend" class="btn btn-primary">Переключить видимость легенды</button>
    </div>

    <?= HighCharts::widget([
        'clientOptions' => [
            'chart' => [
                'type' => 'column'
            ],
            'title' => [
                'text' => 'Популярность задач'
            ],
            'legend' => [
                'enabled' => false,
            ],
            'xAxis' => [
                'categories' => [
                    'Спрос'
                ]
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Количество заказанных задач'
                ]
            ],
            'series' => array_values(ArrayHelper::map(
                Task::find()->all(),
                'id',
                function ($model) {
                    $demand = (int)WorkTask::find()->where(
                        [
                            'task_id' => $model->id
                        ]
                    )->count();

                    return [
                        'name' => $model->category . ' - ' .$model->text,
                        'data' => [
                            $demand
                        ]
                    ];
                }
            ))
        ]
    ]);
    ?>

</div>
