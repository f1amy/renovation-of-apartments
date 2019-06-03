<?php

use yii\helpers\Html;
use dosamigos\highcharts\HighCharts;
use yii\helpers\ArrayHelper;
use app\models\table\Warehouse;
use app\models\table\Item;

use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */

$this->title = 'Отчет по складу';
?>
<div class="report-warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Этот отчет позволяет оценить загруженность складов.</p>

    <?= HighCharts::widget([
        'clientOptions' => [
            'chart' => [
                'type' => 'column'
            ],
            'title' => [
                'text' => 'Загруженность складов'
            ],
            'xAxis' => [
                'categories' => $categories = array_values(
                    ArrayHelper::map(
                        Warehouse::find()->all(),
                        'id',
                        function ($model) {
                            return $model->name;
                        }
                    )
                )
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Количество вещи на складе'
                ]
            ],
            'series' => array_values(
                ArrayHelper::map(
                    Item::find()->all(),
                    'id',
                    function ($model) {
                        $categories = array_values(ArrayHelper::map(
                            Warehouse::find()->all(),
                            'id',
                            function ($model) {
                                return $model->name;
                            }
                        ));
                        $data = [];

                        foreach ($categories as $category) {
                            if ($model->warehouse->name == $category) {
                                array_push($data, (int)$model->quantity);
                            } else {
                                array_push($data, 0);
                            }
                        }

                        $name = $model->name;

                        if (mb_strlen($name) > 20) {
                            $name = trim(mb_substr($name, 0, 17)) . '...';
                        }

                        return [
                            'name' => $name,
                            'data' => $data
                        ];
                    }
                )
            )
        ]
    ]);
    ?>

</div>
