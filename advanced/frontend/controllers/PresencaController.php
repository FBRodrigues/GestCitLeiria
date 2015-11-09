<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Presenca;
use frontend\models\PresencaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresencaController implements the CRUD actions for Presenca model.
 */
class PresencaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Presenca models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresencaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presenca model.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionView($idPresenca, $Aula_idAula)
    {
        return $this->render('view', [
            'model' => $this->findModel($idPresenca, $Aula_idAula),
        ]);
    }

    /**
     * Creates a new Presenca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Presenca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Presenca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionUpdate($idPresenca, $Aula_idAula)
    {
        $model = $this->findModel($idPresenca, $Aula_idAula);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idPresenca' => $model->idPresenca, 'Aula_idAula' => $model->Aula_idAula]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Presenca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return mixed
     */
    public function actionDelete($idPresenca, $Aula_idAula)
    {
        $this->findModel($idPresenca, $Aula_idAula)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presenca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idPresenca
     * @param integer $Aula_idAula
     * @return Presenca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idPresenca, $Aula_idAula)
    {
        if (($model = Presenca::findOne(['idPresenca' => $idPresenca, 'Aula_idAula' => $Aula_idAula])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //Invocar métodos do search
}
