<?php

namespace app\controllers\table;

use app\models\table\ExitToObject;
use app\models\table\search\ExitToObjectSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ExitToObjectController implements the CRUD actions for ExitToObject model.
 */
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
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['headOfAccounting', 'brigadier'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['brigadeWorker'],
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

    /**
     * Lists all ExitToObject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExitToObjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ExitToObject model.
     * If creation is successful, the browser will be redirected
     * to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException('Доступ к запрашиваемой странице запрещен.');
        }

        $model = new ExitToObject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExitToObject model.
     * If update is successful, the browser will be redirected
     * to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException('Доступ к запрашиваемой странице запрещен.');
        }

        $model = $this->findModel($id);

        $model->brigade_gathering_datetime = \Yii::$app->formatter
            ->asDate($model->brigade_gathering_datetime, 'php:d.m.Y H:i');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ExitToObject model.
     * If deletion is successful, the browser will be redirected
     * to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (yii\db\IntegrityException $e) {
            if (strpos(
                $e->errorInfo[2],
                'a foreign key constraint fails'
            ) !== false) {
                Yii::$app->session
                    ->setFlash('error', 'Невозможно удалить запись ' .
                        'которая используется в других таблицах.');
            } else {
                throw $e;
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExitToObject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExitToObject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExitToObject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}
