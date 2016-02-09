<?php

namespace backend\controllers;

use backend\models\Categorias;
use backend\models\Categorizacao;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use backend\models\Aluno;
use backend\models\AlunoSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller
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
     * Lists all Aluno models.
     * @return mixed
     */
    public function actionIndex()
    {

        $session = new Yii::$app->session;
        $session->open();
        $session['Sexo'] = Yii::$app->request->post('Aluno')['Sexo'];
        $session['Escaloes']=Yii::$app->request->post('Aluno')['Escaloes'];
        $session['Categorias'] = Yii::$app->request->post('Aluno')['categorias'];

        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    /**
     * Displays a single Aluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionView2(){

        $model = new Aluno();

        return $this->render('view2', [
            'model'=>$model,

        ]);
    }


    /**
     * Creates a new Aluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aluno();


        $now = new \DateTime('now');
        $dataNas = new \DateTime($model->DataNascimento);
        $idade = date_diff($dataNas,$now);

        $idade = $idade->format('%y');
        $model->Idade = $idade;

        $model->save();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $now = new \DateTime('now');
            $dataNas = new \DateTime($model->DataNascimento);
            $idade = date_diff($dataNas,$now);
            $idade = $idade->format('%y');
            $model->Idade = $idade;
            $model->save();
            Yii::$app->getSession()->setFlash('success', 'Aluno ' . $model->Nome . ' adicionado  com sucesso!');
            return $this->redirect(['view', 'id' => $model->idAluno]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }

    /**
     * Updates an existing Aluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $now = new \DateTime('now');
        $dataNas = new \DateTime($model->DataNascimento);

        $idade = date_diff($dataNas,$now);

        $idade = $idade->format('%y');
        $model->Idade = $idade;

        $model->save();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            date_default_timezone_set("Europe/Lisbon");
            $now = new \DateTime('now');

            $dataNas = new \DateTime($model->DataNascimento);



            $idade = date_diff($dataNas,$now);


            $idade = $idade->format('%y');
            $model->Idade = $idade;

            $model->save();


            Yii::$app->getSession()->setFlash('success', 'Aluno ' . $model->Nome . ' editado  com sucesso!');
            return $this->redirect(['view', 'id' => $model->idAluno]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aluno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success','Aluno apagado com  sucesso');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aluno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
