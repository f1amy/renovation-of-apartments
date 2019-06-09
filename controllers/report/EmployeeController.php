<?php

namespace app\controllers\report;

use Yii;
use yii\web\Controller;
use app\models\EmployeeReport;
use yii\filters\AccessControl;

class EmployeeController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['headOfAccounting'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new EmployeeReport();

        if ($model->load(Yii::$app->request->get()) && $model->validate()) {
            $model->start_date = Yii::$app
                ->formatter->asDate($model->start_date, 'php:d.m.Y');
            $model->end_date = Yii::$app
                ->formatter->asDate($model->end_date, 'php:d.m.Y');

            return $this->render('index', [
                'model' => $model,
                'reportDates' => [
                    'start_date' => $model->start_date,
                    'end_date' => $model->end_date
                ]
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
