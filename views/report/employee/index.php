<?php

use yii\helpers\Html;
use dosamigos\highcharts\HighCharts;
use yii\helpers\ArrayHelper;
use app\models\table\Employee;
use app\models\table\RenovatingBrigade;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */

$this->title = 'Отчет по сотрудникам';
?>
<div class="report-employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Этот отчет покажет кто сколько раз выходил в этом месяце и поможет
        рассчитать заработную плату сотрудникам.</p>

    <?= HighCharts::widget([
        'clientOptions' => [
            'chart' => [
                'type' => 'bar'
            ],
            'title' => [
                'text' => 'Выезды рабочих'
            ],
            'xAxis' => [
                'categories' => [
                    'Выезд',
                ]
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Количество выездов рабочего бригады'
                ]
            ],
            'series' => array_values(ArrayHelper::map(
                Employee::find()->where(['position' => 'Рабочий'])
                    ->orWhere(['position' => 'Бригадир'])->all(),
                'id',
                function ($model) {
                    $exits = (int)RenovatingBrigade::find()->where(
                        [
                            'employee_id' => $model->id
                        ]
                    )->count();

                    $full_name = $model->full_name;

                    if (mb_strlen($full_name) > 20) {
                        $full_name = trim(mb_substr($full_name, 0, 17)) . '...';
                    }

                    return [
                        'name' => $full_name,
                        'data' => [
                            $exits
                        ]
                    ];
                }
            ))
        ]
    ]);
    ?>

</div>
