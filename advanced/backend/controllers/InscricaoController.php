<?php

namespace backend\controllers;

use backend\models\PagamentoSearch;
use Yii;
use backend\models\Inscricao;
use backend\models\InscricaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Pagamento;

/**
 * InscricaoController implements the CRUD actions for Inscricao model.
 */
class InscricaoController extends Controller
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
     * Lists all Inscricao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InscricaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inscricao model.
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
     * Creates a new Inscricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function  actionCreate2(){
        $model = new Inscricao();
        if($model->load(Yii::$app->request->post()) && $model->save()){


        }else {
            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }
    public function actionCreate()
    {
        $model = new Inscricao();
        $searchModel = new InscricaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $tipoIns = Yii::$app->request->post('Inscricao')['tipo'];
            $dataInicio = Yii::$app->request->post('Inscricao')['dataInicio'];

            if ($tipoIns == 'anual') {
                $numRepeticoes = 12;
            } else {
                $numRepeticoes = 1;
            }
            for ($i = 1; $i <= $numRepeticoes; $i++) {
                $date = $dataInicio;
                $date = strtotime(date("Y-m-d", strtotime($date)) . " " . $i . "month");
                $date = date("Y-m-08", $date);
                //   $date1 = date("Y-m-d ");
                $modelPagamento = new Pagamento();
                $modelPagamento->idInscricao = $model->idInscricao;
                $modelPagamento->dataMaxPagamento = $date;
                $modelPagamento->nrAulas = $model->nrAulas;
                $modelPagamento->situacao = "Pendente";
                $modelPagamento->save();
                //      var_dump($modelPagamento);
            }
            return $this->render('index', [
                'model' => $model,
                'searchModel'=>$searchModel,
                'dataProvider'=> $dataProvider,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }




    /**
     * Updates an existing Inscricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idInscricao]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inscricao model.
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
     * Finds the Inscricao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inscricao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inscricao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
