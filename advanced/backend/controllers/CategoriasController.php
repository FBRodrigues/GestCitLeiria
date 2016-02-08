<?php

namespace backend\controllers;

use Yii;
use backend\models\Categorias;
use backend\models\CategoriasSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriasController implements the CRUD actions for Categorias model.
 */
class CategoriasController extends Controller
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
     * Lists all Categorias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categorias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categorias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success','Categoria ' . $model->Valor . ' adicionada com sucesso!');
            return $this->redirect(['view', 'id' => $model->idCategorias]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categorias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        //return Json::encode($valor->Valor);
     // return Json::decode($search);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
       /*     if ($search == $model->Valor) {
                Yii::$app->getSession()->setFlash('error', 'Categoria ' . $model->Valor .
                    ' tem o mesmo Nome! Escreva outra nome!');
                return $this->render('update', [
                    'model' => $model,
                ]);

            } else {
                Yii::$app->getSession()->setFlash('success', 'Categoria ' . $model->Valor . ' editada com sucesso!');

                return $this->redirect(['view', 'id' => $model->idCategorias]);
            }*/
            Yii::$app->getSession()->setFlash('success', 'Categoria ' . $model->Valor . ' editada com sucesso!');

            return $this->redirect(['view', 'id' => $model->idCategorias]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
            //return $this->redirect(['view', 'id' => $model->idCategorias]);



    /**
     * Deletes an existing Categorias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success','Categoria apagada com sucesso!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Categorias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categorias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categorias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
