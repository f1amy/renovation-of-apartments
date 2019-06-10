<?php

use dosamigos\highcharts\HighCharts;
use yii\helpers\ArrayHelper;
use app\models\table\Employee;
use app\models\table\RenovatingBrigade;
use yii\bootstrap4\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */

$this->title = 'Отчет по сотрудникам';
?>
<div class="report-employee-index">

    <div class="form-group">
        <?= Html::a(
            FAS::icon('arrow-left') . ' Назад',
            Yii::$app->request->referrer !== null ?
                Yii::$app->request->referrer : Yii::$app->homeUrl,
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Этот отчет покажет кто сколько раз выходил в выбранный промежуток
        времени и поможет рассчитать заработную плату сотрудникам.</p>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['report/employee/index']),
        'options' => ['class' => 'col-lg-9'],
        'fieldConfig' => ['options' => ['class' => 'form-group col-md']],
    ]); ?>

    <div class="form-row">
        <?= $form->field($model, 'start_date')->widget(
            DateTimePicker::className(),
            [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    'minView' => 2,
                    'todayBtn' => true,
                ]
            ]
        ) ?>
        <?= $form->field($model, 'end_date')->widget(
            DateTimePicker::className(),
            [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                    'minView' => 2,
                    'todayBtn' => true,
                ]
            ]
        ) ?>
        <div class="form-group col-md-auto">
            <label class="d-md-block d-none">&nbsp;</label>
            <?= Html::submitButton('Показать', [
                'class' => 'btn btn-success'
            ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    if ($reportDates !== null) {
        $endDate = date('Y-m-d', strtotime($reportDates['end_date'] . ' +1 day'));

        $series = array_values(ArrayHelper::map(
            Employee::find()->where(['position' => 'Рабочий'])
                ->orWhere(['position' => 'Бригадир'])->all(),
            'id',
            function ($model) use ($reportDates, $endDate) {
                $exits = (int)RenovatingBrigade::find()
                    ->joinWith('exitToObject')->where(
                        [
                            'employee_id' => $model->id,
                        ]
                    )->andWhere([
                        'between',
                        'brigade_gathering_datetime',
                        $reportDates['start_date'],
                        $endDate
                    ])->count();

                return [
                    'name' => $model->full_name,
                    'data' => [
                        $exits
                    ]
                ];
            }
        ));

        $exitsCount = 0;

        foreach ($series as $value) {
            $exitsCount += $value['data'][0];
        }

        if ($exitsCount > 0) {
            echo Html::tag(
                'h5',
                'Всего совершено выходов на объект рабочими: '
                    . $exitsCount . '.',
                ['class' => 'mt-2 text-center']
            );

            $startDateFriendly = date(
                "d.m.Y",
                strtotime($reportDates['start_date'])
            );
            $endDateFriendly = date(
                "d.m.Y",
                strtotime($reportDates['end_date'])
            );

            echo HighCharts::widget([
                'clientOptions' => [
                    'chart' => [
                        'type' => 'bar'
                    ],
                    'title' => [
                        'text' => 'Выезды рабочих c ' . $startDateFriendly .
                            ' по ' . $endDateFriendly
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
                    'series' => $series
                ]
            ]);
        } else {
            echo Html::tag(
                'h5',
                'Не найдено ни одного выхода на объект в выбранном диапазоне дат.',
                ['class' => 'mt-2 text-center']
            );
        }
    } else {
        echo Html::tag(
            'h5',
            'Пожалуйста, выберите диапазон дат.',
            ['class' => 'mt-2 text-center']
        );
    }
    ?>
</div>
