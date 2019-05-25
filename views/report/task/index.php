<?php

use yii\helpers\Html;
use dosamigos\highcharts\HighCharts;
use yii\helpers\ArrayHelper;
use app\models\table\Task;
use app\models\table\WorkTask;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */

$this->title = 'Отчет по задачам';
?>
<div class="report-task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Этот отчет позволяет узнать спрос на выполняемые ремонтной бригадой задачи.</p>

    <?= HighCharts::widget([
        'clientOptions' => [
            'chart' => [
                'type' => 'column'
            ],
            'title' => [
                'text' => 'Популярность задач'
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

                    $taskText = $model->text;

                    if (mb_strlen($taskText) > 20) {
                        $taskText = trim(mb_substr($taskText, 0, 17)) . '...';
                    }

                    return [
                        'name' => $taskText,
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
