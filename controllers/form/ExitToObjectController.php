<?php

namespace app\controllers\form;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\table\ExitToObject;
use app\models\table\search\RenovatingBrigadeSearch;
use app\models\table\search\EquipmentSearch;
use app\models\table\search\WorkTaskSearch;
use app\models\table\RenovatingBrigade;
use app\models\table\WorkTask;
use app\models\table\Equipment;

class ExitToObjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update'],
                        'roles' => ['headOfAccounting', 'brigadier'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $exitToObject = new ExitToObject();

        if (
            $exitToObject->load(Yii::$app->request->post())
            && $exitToObject->save()
        ) {
            return $this->redirect([
                'form/exit-to-object/update',
                'id' => $exitToObject->id
            ]);
        }

        return $this->render('create', [
            'exitToObject' => $exitToObject,
        ]);
    }

    public function actionUpdate($id)
    {
        $exitToObject = ExitToObject::findOne($id);

        if (!$exitToObject) {
            throw new NotFoundHttpException("Выход на объект не найден.");
        }

        $exitToObject->brigade_gathering_datetime = \Yii::$app->formatter
            ->asDate($exitToObject->brigade_gathering_datetime, 'php:d.m.Y H:i');

        if (
            $exitToObject->load(Yii::$app->request->post())
            && $exitToObject->save()
        ) {
            return $this->redirect([
                'form/exit-to-object/update',
                'id' => $exitToObject->id
            ]);
        }

        $renovatingBrigadeSearchModel = new RenovatingBrigadeSearch();
        $renovatingBrigadeDataProvider = $renovatingBrigadeSearchModel
            ->search(Yii::$app->request->queryParams);
        $renovatingBrigadeDataProvider->query->andFilterWhere(
            ['exit_to_object_id' => $exitToObject->id]
        );
        $renovatingBrigadeDataProvider->pagination->pageParam = 'renovating_brigade-page';
        $renovatingBrigadeDataProvider->sort->sortParam = 'renovating_brigade-sort';
        $renovatingBrigadeDataProvider->pagination->pageSize = 7;

        $equipmentSearchModel = new EquipmentSearch();
        $equipmentDataProvider = $equipmentSearchModel
            ->search(Yii::$app->request->queryParams);
        $equipmentDataProvider->query->andFilterWhere(
            ['exit_to_object_id' => $exitToObject->id]
        );
        $equipmentDataProvider->pagination->pageParam = 'equipment-page';
        $equipmentDataProvider->sort->sortParam = 'equipment-sort';
        $equipmentDataProvider->pagination->pageSize = 7;

        $workTaskSearchModel = new WorkTaskSearch();
        $workTaskDataProvider = $workTaskSearchModel
            ->search(Yii::$app->request->queryParams);
        $workTaskDataProvider->query->andFilterWhere(
            ['exit_to_object_id' => $exitToObject->id]
        );
        $workTaskDataProvider->pagination->pageParam = 'work_task-page';
        $workTaskDataProvider->sort->sortParam = 'work_task-sort';
        $workTaskDataProvider->pagination->pageSize = 7;

        return $this->render('update', [
            'exitToObject' => $exitToObject,
            'renovatingBrigadeDataProvider' => $renovatingBrigadeDataProvider,
            'renovatingBrigadeSearchModel' => $renovatingBrigadeSearchModel,
            'equipmentDataProvider' => $equipmentDataProvider,
            'equipmentSearchModel' => $equipmentSearchModel,
            'workTaskDataProvider' => $workTaskDataProvider,
            'workTaskSearchModel' => $workTaskSearchModel,
        ]);
    }

    public function actionDelete($id, $table, $returnId)
    {
        if ($table === 'renovating-brigade') {
            $renovatingBrigade = RenovatingBrigade::findOne($id);

            if ($renovatingBrigade !== null) {
                $renovatingBrigade->delete();
            } else {
                throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
            }
        } else if ($table === 'work-task') {
            $workTask = WorkTask::findOne($id);

            if ($workTask !== null) {
                $workTask->delete();
            } else {
                throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
            }
        } else if ($table === 'equipment') {
            $equipment = Equipment::findOne($id);

            if ($equipment !== null) {
                $item = $equipment->item;
                $item->quantity += $equipment->item_quantity;
                $item->save();

                $equipment->delete();
            } else {
                throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
            }
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }

        $exitToObject = ExitToObject::findOne($returnId);

        if ($exitToObject !== null) {
            return $this->redirect(['update', 'id' => $returnId]);
        }

        return $this->redirect(['table/exit-to-object']);
    }
}
