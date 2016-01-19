<?php

namespace backend\controllers;

use backend\models\Categorias;
use backend\models\Categorizacao;
use Yii;
use backend\models\Aluno;
use backend\models\AlunoSearch;
use yii\db\Query;
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
        $session['Categorizacaos'] = Yii::$app->request->post('Aluno')['Categorizacaos'];

       /* $query = new \yii\db\Query();
        $data = $query->select(['Valor','Aluno.idAluno'])
            ->from('Categorias')
            ->join('INNER JOIN ', 'Categorizacao','Categorizacao.Categorias_idCategorias = Categorias.idCategorias')
            ->join('INNER JOIN','Aluno','Categorizacao.Aluno_idAluno = Aluno.idAluno')
            ->all();*/


        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //var_dump($dataProvider);
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
      //  $dataProvider = Aluno::getAllCategorias($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
          //  'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionView2(){

        $model = new Aluno();
      //  $escolhCate = (array)Yii::$app->request->post('selection');

       // var_dump($escolhCate);
        //     //   return \yii\helpers\Json::encode($escolhCate);
     //   $model->Escalao_idEscalao = $escolhCate;
     //   var_dump( $model->Escalao_idEscalao);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
