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

    <p>Этот отчет позволяет определить загруженность складов.</p>

    <?= HighCharts::widget([
        'clientOptions' => [
            'chart' => [
                'type' => 'bar'
            ],
            'title' => [
                'text' => 'Загруженность складов'
            ],
            'xAxis' => [
                'categories' => [
                    'Материал',
                    'Инструмент'
                ]
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Количество вещи на складе'
                ]
            ],
            'series' => array_values(ArrayHelper::map(
                Warehouse::find()->all(),
                'id',
                function ($model) {
                    $materialsStock = (int)Item::find()->where(
                        [
                            'warehouse_id' => $model->id,
                            'type' => 'Материал'
                        ]
                    )->count();

                    $instrumentsStock = (int)Item::find()->where(
                        [
                            'warehouse_id' => $model->id,
                            'type' => 'Инструмент'
                        ]
                    )->count();

                    $name = $model->name;

                    if (mb_strlen($name) > 20) {
                        $name = trim(mb_substr($name, 0, 17)) . '...';
                    }

                    return [
                        'name' => $name,
                        'data' => [
                            $materialsStock,
                            $instrumentsStock
                        ]
                    ];
                }
            ))
        ]
    ]);
    ?>

</div>
